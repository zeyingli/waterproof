<?php

use App\Admin\Extensions\Column\ExpandRow;
use App\Admin\Extensions\Column\FloatBar;
use App\Admin\Extensions\Column\OpenMap;
use App\Admin\Extensions\Column\Qrcode;
use App\Admin\Extensions\Column\UrlWrapper;
use App\Admin\Extensions\Form\WangEditor;
use App\Admin\Extensions\Nav\Links;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Column;

Form::forget(['map', 'editor']);
//Form::extend('editor', WangEditor::class);
Column::extend('expand', ExpandRow::class);
Column::extend('openMap', OpenMap::class);
Column::extend('floatBar', FloatBar::class);
Column::extend('qrcode', Qrcode::class);
Column::extend('urlWrapper', UrlWrapper::class);
Column::extend('action', Grid\Displayers\Actions::class);
Column::extend('prependIcon', function ($value, $icon) {
    return "<span style='color: #999;'><i class='fa fa-$icon'></i>  $value</span>";
});

app('view')->prependNamespace('admin', resource_path('views/administration'));
Encore\Admin\Form::extend('media', \Encore\FileBrowser\FileBrowserField::class);

// Admin::navbar(function (\Encore\Admin\Widgets\Navbar $navbar) {
//     $navbar->left(view('admin.search-bar'));
//     $navbar->right(new Links());
// });
