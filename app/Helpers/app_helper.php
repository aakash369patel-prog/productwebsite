<?php

if (! function_exists('create_slug')) {
    function create_slug(string $text, string $table, ?int $excludeId = null): string
    {
        $slug = url_title($text, '-', true);
        $model = match ($table) {
            'product_categories' => model(\App\Models\ProductCategoryModel::class),
            'products'           => model(\App\Models\ProductModel::class),
            default              => null,
        };

        if ($model === null) {
            return $slug;
        }

        $original = $slug;
        $counter  = 1;

        while (true) {
            $builder = $model->where('slug', $slug);

            if ($excludeId) {
                $builder->where('id !=', $excludeId);
            }

            if ($builder->countAllResults() === 0) {
                break;
            }

            $slug = $original . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}

if (! function_exists('upload_url')) {
    function upload_url(?string $path): string
    {
        if (empty($path)) {
            return base_url('assets/images/placeholder.svg');
        }

        if (str_starts_with($path, 'http')) {
            return $path;
        }

        return base_url('uploads/' . ltrim($path, '/'));
    }
}

if (! function_exists('format_date')) {
    function format_date(?string $date, string $format = 'd M Y'): string
    {
        if (empty($date)) {
            return '';
        }

        return date($format, strtotime($date));
    }
}

if (! function_exists('truncate_text')) {
    function truncate_text(?string $text, int $length = 120): string
    {
        $text = strip_tags($text ?? '');

        if (strlen($text) <= $length) {
            return $text;
        }

        return substr($text, 0, $length) . '...';
    }
}

if (! function_exists('site_name')) {
    function site_name(): string
    {
        return env('app.siteName', 'Global Export Solutions');
    }
}

if (! function_exists('admin_user')) {
    function admin_user(): ?array
    {
        return session()->get('admin_user');
    }
}
