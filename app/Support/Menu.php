<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Menu
{
    /** Resolve an item's destination URL. Leaves with no route fall back to a scaffold page. */
    public static function href(array $item): string
    {
        if (! empty($item['href']) && $item['href'] !== '#') {
            return $item['href'];
        }

        if (! empty($item['route']) && Route::has($item['route'])) {
            $url = route($item['route'], $item['params'] ?? []);

            return $url.(! empty($item['hash']) ? '#'.$item['hash'] : '');
        }

        // Every leaf is navigable — generate a scaffold page URL from its label.
        return route('page', ['path' => Str::slug($item['label'] ?? 'page')]);
    }

    /** Is this item (or any descendant) the current page? */
    public static function active(array $item): bool
    {
        $href = self::href($item);
        $current = rtrim(url()->current(), '/');

        if ($href && rtrim($href, '/') === $current) {
            return true;
        }

        foreach ($item['children'] ?? [] as $child) {
            if (self::active($child)) {
                return true;
            }
        }

        return false;
    }

    /** True when the item expands into a submenu. */
    public static function hasChildren(array $item): bool
    {
        return ! empty($item['children']);
    }

    /** Flat list of navigable leaves for the command palette / search. */
    public static function leaves(): array
    {
        $out = [];

        $walk = function (array $items, ?string $group, ?string $icon) use (&$walk, &$out) {
            foreach ($items as $item) {
                $itemIcon = $item['icon'] ?? $icon;
                if (self::hasChildren($item)) {
                    $walk($item['children'], $group, $itemIcon);
                } else {
                    $out[] = [
                        'label' => $item['label'],
                        'href'  => self::href($item),
                        'group' => $group,
                        'icon'  => $itemIcon ?? 'circle',
                    ];
                }
            }
        };

        foreach (config('adminkit.menu', []) as $group) {
            $walk($group['items'], $group['group'] ?? null, null);
        }

        return array_values(collect($out)->unique(fn ($i) => $i['href'].'|'.$i['label'])->all());
    }

    /** Breadcrumb trail (array of labels) for a scaffold page slug. */
    public static function trail(string $slug): array
    {
        $found = [];

        $dfs = function (array $items, array $acc) use (&$dfs, &$found, $slug) {
            foreach ($items as $item) {
                $path = array_merge($acc, [$item['label']]);
                if (self::hasChildren($item)) {
                    if ($dfs($item['children'], $path)) {
                        return true;
                    }
                } elseif (Str::slug($item['label']) === $slug) {
                    $found = $path;

                    return true;
                }
            }

            return false;
        };

        foreach (config('adminkit.menu', []) as $group) {
            if ($dfs($group['items'], [])) {
                break;
            }
        }

        return $found;
    }

    /** First navigable leaf under an item (itself if it's already a leaf). */
    public static function firstLeaf(array $item): ?array
    {
        if (! self::hasChildren($item)) {
            return $item;
        }

        foreach ($item['children'] as $child) {
            if ($leaf = self::firstLeaf($child)) {
                return $leaf;
            }
        }

        return null;
    }

    /**
     * Clickable breadcrumb trail for a scaffold page slug.
     * Each ancestor links to its first child page; the current page has no link.
     *
     * @return array<int, array{label: string, href: ?string}>
     */
    public static function breadcrumbs(string $slug): array
    {
        $path = [];

        $dfs = function (array $items, array $acc) use (&$dfs, &$path, $slug) {
            foreach ($items as $item) {
                $node = array_merge($acc, [$item]);
                if (self::hasChildren($item)) {
                    if ($dfs($item['children'], $node)) {
                        return true;
                    }
                } elseif (Str::slug($item['label']) === $slug) {
                    $path = $node;

                    return true;
                }
            }

            return false;
        };

        foreach (config('adminkit.menu', []) as $group) {
            if ($dfs($group['items'], [])) {
                break;
            }
        }

        $last = count($path) - 1;

        return array_map(function ($item, $i) use ($last) {
            $leaf = $i === $last ? null : self::firstLeaf($item);

            return ['label' => $item['label'], 'href' => $leaf ? self::href($leaf) : null];
        }, $path, array_keys($path));
    }
}
