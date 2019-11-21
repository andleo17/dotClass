<?php

    class Util {

        public static function convertirTiempo($tiempo) {
            $elementos = explode(':', $tiempo);
            $texto = '';
            if ($elementos[0] != '00') {
                $texto = $texto . "$elementos[0] h ";
            }
            if ($elementos[1] != '00') {
                $texto = $texto . "$elementos[1] min ";
            }
            if ($elementos[2] != '00') {
                $texto = $texto . "$elementos[2] seg";
            }
            return $texto;
        }

        public static function convertirCantidades($cantidad) {
            $texto = '';
            if (0 <= $cantidad AND $cantidad < 1000) {
                $texto = $cantidad;
            } elseif (1000 <= $cantidad AND $cantidad < 1000000) {
                $texto = round($cantidad / 1000, 2) . 'K';
            } elseif (1000000 <= $cantidad) {
                $texto = round($cantidad / 1000000, 2) . 'M';
            }
            return $texto;
        }

    }