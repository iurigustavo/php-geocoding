<?php


    namespace App\Http\Helpers;

    use App\Classes\Theme\Metronic;
    use Illuminate\Database\Eloquent\Model;

    class FormUtils
    {

        /**
         * @param  Model|String                         $model
         * @param                                       $key
         * @param                                       $desc
         *
         * @return array
         */
        public static function pluckIdDescWithEmpty($model, $key, $desc)
        {

            return ["" => "---"] + self::pluckIdDesc($model, $key, $desc);
        }

        /**
         * @param  Model                                $model
         * @param                                       $key
         * @param                                       $desc
         *
         * @return array
         */
        public static function pluckIdDesc($model, $key, $desc)
        {
            return $model::query()->pluck($desc, $key)->toArray();
        }

        /**
         * @param  string  $enabled
         * @param  string  $disabled
         *
         * @return array
         */
        public static function pluckEnabledDisabled($enabled = 'Enabled', $disabled = 'Disabled')
        {
            return ["" => "---", 1 => $enabled, 0 => $disabled];
        }

        public static function btnModal($id)
        {
            return '
<button type="button" class="btn btn-default skin-purple" data-toggle="modal" data-target="#modal'.
                $id.'">
            <i class="fa fa-search"></i>
        </button>';
        }


        public static function btnEdit($route, $id): string
        {
            return "<a href='".route($route, $id)."' title='Edit' class='btn btn-icon btn-light-warning btn-circle'>".Metronic::getSVGDT("media/svg/icons/Communication/Write.svg", "svg-icon svg-icon-md").
                "</a> ";
        }

        public static function btnShow($route, $id): string
        {
            return "<a href='".route($route, $id)."' title='Show' class='btn btn-icon btn-light-primary btn-circle'>".Metronic::getSVGDT("media/svg/icons/General/Search.svg", "svg-icon svg-icon-md").
                "</a> ";
        }

        public static function btnDestroy($route, $id): string
        {
            $stringId = is_array($id) ? implode('-', $id) : $id;

            return "
            
            <a href='#' onclick=\"deleteConfirm('delete-form-{$stringId}')\" title='Destroy' class='btn btn-icon btn-light-danger btn-circle'>".Metronic::getSVGDT("media/svg/icons/General/Trash.svg", "svg-icon svg-icon-md").
                "</a> 
            <form id='delete-form-{$stringId}' action='".route($route, $id)."' method='POST'><input name='_method' type='hidden' value='delete'></form>
            ";
        }


        public static function btnAcaoComExcluir($routeEdit, $routeDestroy, $id)
        {

            $r = "<div style='text-align: center'>";
            $r .= "<a style='display:inline-block'  href='".route($routeEdit, $id)."'
class='btn btn-sm btn-text-success btn-hover-light-success font-weight-bold mr-2'  title='Editar' ><i class=\"fa fa-edit\"></i></a>";
            $r .=
//            '<a href="" class="delete-confirmation btn btn-sm btn-text-danger btn-hover-light-danger font-weight-bold mr-2"
//data-id="' . $id . '" data-routeDestroy="' . $routeDestroy . '"><i class="fa fa-trash"></i></a>';

                '<button class="remove-confirmation btn btn-sm btn-text-danger btn-hover-light-danger font-weight-bold mr-2"
        data-id="'.$id.'" data-action="'.route($routeDestroy, $id).'"><i class="fa fa-trash"></i></button>';
            $r .= "</div>";
            return $r;
        }


        public static function btnPopover($titulo, $msg, $icon): string
        {

            return '<button class="btn btn-default popovers"
							data-html="true"
							data-container="body" onclick=" "
							data-trigger="hover" data-placement="left"
							data-content=" '.$msg.' "
							data-original-title="<b>'.$titulo.'</b>"><i class="fa '.$icon.'" ></i></button>';
        }


    }