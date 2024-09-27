<?php /**
 * @author    Raúl Zavaleta Zea <raul.zavaletazea@gmail.com>
 * @package   application.helpers
 * @copyright 2019 Losn International, Todos los Derechos Reservados
 * @version   1.0
 */

defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('America/Mexico_City');

if (!function_exists('app_name')) {
    /**
     * Retornamos el nombre comercial del proyecto
     * @return String Nombre del proyecto
     */
    function app_name()
    {
        return 'the italian coffee company';
    }
}

if (!function_exists('safe_url')) {
    /**
     * A partir de una cadena de texto, generamos un parametro valido en URL
     * @param  String $cadena cadena d etexto
     * @return String         parametro valido de URL
     */
    function safe_url($cadena)
    {
        $cadena = safe_string($cadena);
        $cadena = strtolower($cadena);
        $cadena = str_replace(' ', '-', $cadena);

        return $cadena;
    }
}

if (!function_exists('limpia_telefono')) {
    /**
     * Eliminamos los caracteres extras del telefono
     *
     * A partir del telefono con mascara (999) 999-99-99
     * eliminamoos los valores extras y solo nos quedamos con los
     * numros
     *
     * @since   1.0
     * @version 1.0
     * @author  Raul Zavaleta Zea <raul.zavaletazea@kiapp.mx>
     * @param   String $telefono  Telefono con mascara
     * @return  String            El telefono sólo en formato numérico
     */
    function limpia_telefono($telefono)
    {
        $telefono = str_replace(' ', '', $telefono);
        $telefono = str_replace('(', '', $telefono);
        $telefono = str_replace(')', '', $telefono);
        $telefono = str_replace('-', '', $telefono);

        return $telefono;
    }
}

if (!function_exists('fancy_mouth')) {
    function fancy_mouth($date)
    {
        $fecha = strtotime($date);
        $mes = date('m', $fecha);
        $messtring = '';
        switch ($mes) {
            case '1':
                $messtring = 'ENE';
                break;
            case '2':
                $messtring = 'FEB';
                break;
            case '3':
                $messtring = 'MAR';
                break;
            case '4':
                $messtring = 'ABR';
                break;
            case '5':
                $messtring = 'MAY';
                break;
            case '6':
                $messtring = 'JUN';
                break;
            case '7':
                $messtring = 'JUL';
                break;
            case '8':
                $messtring = 'AGO';
                break;
            case '9':
                $messtring = 'SEP';
                break;
            case '10':
                $messtring = 'OCT';
                break;
            case '11':
                $messtring = 'NOV';
                break;
            case '12':
                $messtring = 'DIC';
                break;

            default:
                $messtring = 'si';
                break;
        }
        return $messtring;
    }
}
if (!function_exists('fancy_telefono')) {
    /**
     * [fancya_telefono description]
     * @param  [type] $telefono [description]
     * @return [type]           [description]
     */
    function fancy_telefono($telefono)
    {
        $fancy_telefono = '(' . substr($telefono, 0, 3) . ') ';
        $fancy_telefono .= substr($telefono, 3, 3) . '-';
        $fancy_telefono .= substr($telefono, 6, 4);

        return $fancy_telefono;
    }
}

if (!function_exists('json_header')) {
    /**
     * Generamos una cabecera de contenido JSON con
     * charset urf-8
     * @return void
     */
    function json_header()
    {
        header('Content-Type: application/json; charset=utf-8');
    }
}

if (!function_exists('http_error')) {
    /**
     * Generamos una cabecera http a partir de los codigos de
     * error estandar de HTTP
     * @param  int $error_code numero de error defecto de http
     * @return void
     */
    function http_error($error_code = 404)
    {
        header('X-PHP-Response-Code: ' . $error_code, true, (int) $error_code);
    }
}

if (!function_exists('safe_string')) {
    /**
     * limpiamos los caracteres especiales de una cadena de
     * texto, nada mas agregale mas caracteres.
     *
     * De nada paps...
     *
     * @param  String  $string   cadena de texto a limpiar
     * @param  boolean $espacios define si respetamos los espacios o los
     *                           reemplazamos por guiones medios
     * @return String            Cadena sin caracteres especiales
     */
    function safe_string($string, $espacios = false)
    {
        $string = str_replace(['á', 'à', 'â', 'ã', 'ª', 'ä'], 'a', $string);
        $string = str_replace(['Á', 'À', 'Â', 'Ã', 'Ä'], 'A', $string);
        $string = str_replace(['Í', 'Ì', 'Î', 'Ï'], 'I', $string);
        $string = str_replace(['í', 'ì', 'î', 'ï'], 'i', $string);
        $string = str_replace(['é', 'è', 'ê', 'ë'], 'e', $string);
        $string = str_replace(['É', 'È', 'Ê', 'Ë'], 'E', $string);
        $string = str_replace(['ó', 'ò', 'ô', 'õ', 'ö', 'º'], 'o', $string);
        $string = str_replace(['Ó', 'Ò', 'Ô', 'Õ', 'Ö'], 'O', $string);
        $string = str_replace(['ú', 'ù', 'û', 'ü'], 'u', $string);
        $string = str_replace(['Ú', 'Ù', 'Û', 'Ü'], 'U', $string);
        $string = str_replace(['[', '^', '´', '`', '¨', '~', ']'], '', $string);
        $string = str_replace('ç', 'c', $string);
        $string = str_replace('Ç', 'C', $string);
        $string = str_replace('ñ', 'ni', $string);
        $string = str_replace('Ñ', 'NI', $string);
        $string = str_replace('Ý', 'Y', $string);
        $string = str_replace('ý', 'y', $string);

        $string = str_replace('&aacute;', 'a', $string);
        $string = str_replace('&Aacute;', 'A', $string);
        $string = str_replace('&eacute;', 'e', $string);
        $string = str_replace('&Eacute;', 'E', $string);
        $string = str_replace('&iacute;', 'i', $string);
        $string = str_replace('&Iacute;', 'I', $string);
        $string = str_replace('&oacute;', 'o', $string);
        $string = str_replace('&Oacute;', 'O', $string);
        $string = str_replace('&uacute;', 'u', $string);
        $string = str_replace('&Uacute;', 'U', $string);

        $string = str_replace(',', '', $string);
        $string = str_replace(':', '', $string);
        $string = str_replace(';', '', $string);
        $string = str_replace('(', '', $string);
        $string = str_replace(')', '', $string);
        $string = str_replace('+', '', $string);
        $string = str_replace('!', '', $string);
        $string = str_replace('¡', '', $string);
        $string = str_replace('$', '', $string);
        $string = str_replace("'", '', $string);

        return $espacios ? str_replace(' ', '-', $string) : $string;
    }
}

if (!function_exists('fancy_date')) {
    /**
     * creamos una feha con un formato especificado a partir de una fecha SQL
     * @param  Date   $sql_date     Fecha en formato SQL (yyyy-mm-dd)
     * @param  String $request_type Nomenclatura para el retorno de una fecha
     *
     *                              $request_type = 'm-y'
     *                              Retornamos solo el mes y el año de la fecha
     *                              fancy_date('1988-05-29', 'm-y')
     *                              <<mayo de 1988>>
     *
     *                              $request_type = 'd-m-y'
     *                              Retornamos el día, mes y año
     *                              fancy_date('1988-05-29', 'd-m-y')
     *                              <<29 de mayo de 1988>>
     *
     *                              $request_type = 'd-m'
     *                              Retornamos el mes y año
     *                              fancy_date('1988-05-29', 'd-m')
     *                              <<29 de mayo>>
     *
     *                              $request_type = 'w-d-m-y'
     *                              Retornamos el día de la semana,
     *                              el día del mes, el mes y año
     *                              fancy_date('1988-05-29', 'w-d-m-y')
     *                              <<domingo 29 de mayo de 1988>>
     *
     *                              $request_type = 'w-d-m-y-h'
     *                              Retornamos el día de la semana,
     *                              el día del mes, el mes, año y hora
     *                              fancy_date('1988-05-29 23:34', 'w-d-m-y-h')
     *                              <<domingo 29 de mayo de 1988 a las 23:34H>>
     *
     *                              $request_type = 'w'
     *                              Retornamos el día de la semana
     *                              fancy_date('1988-05-29', 'w')
     *                              <<domingo>>
     *
     *                              $request_type = 'd-m-y-h'
     *                              Retornamos el día del mes, el mes,
     *                              año y hora
     *                              fancy_date('1988-05-29 23:34', 'd-m-y-h')
     *                              <<29 de mayo de 1988 a las 23:34H>>
     *
     *                              $request_type = 'slash'
     *                              Retornamos el día del mes, el mes y el año
     *                              separado por diagonales
     *                              fancy_date('1988-05-29', 'slash')
     *                              <<29/mayo/1988>>
     *
     * @return String               Fecha en el formato especificado
     */
    function fancy_date($sql_date = null, $request_type = null)
    {
        $arr_month = [
            '01' => 'enero',
            '02' => 'febrero',
            '03' => 'marzo',
            '04' => 'abril',
            '05' => 'mayo',
            '06' => 'junio',
            '07' => 'julio',
            '08' => 'agosto',
            '09' => 'septiembre',
            '10' => 'octubre',
            '11' => 'noviembre',
            '12' => 'diciembre',
        ];

        $arr_week = [
            'Mon' => 'Lunes',
            'Tue' => 'Martes',
            'Wed' => 'Miércoles',
            'Thu' => 'Jueves',
            'Fri' => 'Viernes',
            'Sat' => 'Sábado',
            'Sun' => 'Domingo',
        ];

        $year = substr($sql_date, 0, 4);
        $month = substr($sql_date, 5, 2);
        $day = substr($sql_date, 8, 2);
        $hour = substr($sql_date, 11, 8);

        $year = !$year ? 0 : $year;
        $month = !$month ? 0 : $month;
        $day = !$day ? 0 : $day;

        if (checkdate($month, $day, $year)) {
            $timestamp = strtotime($sql_date);
            $str_day = date('D', $timestamp);
            $day = (int) $day;

            switch ($request_type) {
                case 'm-y':
                    return $arr_month[$month] . ' de ' . $year;
                    break;

                case 'd-m-y': //REGRESAREMOS EL DIA, MES Y EL AÑO
                    return $day . ' de ' . $arr_month[$month] . ' de ' . $year;
                    break;

                case 'd-m': //REGRESAREMOS EL DIA Y EL MES
                    return $day . ' de ' . $arr_month[$month];
                    break;

                case 'w-d-m-y': //REGRESA EL DIA DE LA SEMANA, DIA DEL MES, MES Y AÑO
                    return $arr_week[$str_day] .
                        ' ' .
                        $day .
                        ' de ' .
                        $arr_month[$month] .
                        ' de  ' .
                        $year;
                    break;

                case 'w-d-m-y-h': //REGRESA EL DIA DE LA SEMANA, DIA DEL MES, MES Y AÑO Y LA HORA
                    return $arr_week[$str_day] .
                        ' ' .
                        $day .
                        ' de ' .
                        $arr_month[$month] .
                        ' de  ' .
                        $year .
                        ' a las ' .
                        $hour .
                        'Hrs';
                    break;

                case 'w': //REGRESA EL DIA DE LA SEMANA
                    return $arr_week[$str_day];
                    break;

                case 'd-m-y-h': //REGRESAREMOS EL DIA, MES Y EL AÑO Y LA HORA
                    return $day .
                        ' de ' .
                        $arr_month[$month] .
                        ' de ' .
                        $year .
                        ' a las ' .
                        $hour .
                        'Hrs';
                    break;

                case 'slash': //REGRESAREMOS EL DIA, MES Y EL AÑO
                    return $day . '/' . $month . '/' . $year;
                    break;

                case 'slash-ml': //REGRESAREMOS EL DIA, MES EN LETRA Y EL AÑO
                    return $day .
                        '/' .
                        strtoupper(substr($arr_month[$month], 0, 3)) .
                        '/' .
                        $year;
                    break;

                default:
                    return $day . ' de ' . $arr_month[$month] . ' de ' . $year;
                    break;
            }
        } else {
            return 'NA';
        }
    }
}

if (!function_exists('get_config_value')) {
    /**
     * Tomamos un valor de configuracion de la base de datos
     * @param  String $config_id indice buscado
     * @return String            valor de la configuracion
     */
    function get_config_value($config_id)
    {
        $CI = &get_instance();
        $CI->load->model('common_model');
        return $CI->common_model->get_config_value($config_id);
    }
}

if (!function_exists('is_user_logged_in')) {
    /**
     * Revisamos si se cuenta con una sesión activa
     * @param  boolean $login Si no econtramos en la sección d elogin, buscamos
     *                        redireccionar al panel de control, en las demas
     *                        secciones es inverso, enviamos al login
     * @return Void           Redireccionamos al controlador designado
     */
    function is_user_logged_in($login = false)
    {
        $CI = &get_instance();
        if ($login) {
            if ($CI->session->userdata('signin')) {
                redirect(base_url('app/home'), 'refresh');
            }
        } elseif (!$login) {
            if (!$CI->session->userdata('signin')) {
                $CI->session->set_flashdata(
                    'message',
                    '<h3> <i class="fas fa-exclamation-triangle"></i> Acceso Restringido</h3> Por favor inicia sesión para continuar'
                );
                $CI->session->set_flashdata('message_type', 'danger');
                redirect(base_url('login'));
            }
        }
    }
}



if(!function_exists('verifica_token')){
	
	function verifica_token() {
		
		$CI = &get_instance();
        $idUsuario = $CI->session->userdata('idusuario');
		$correo = $CI->session->userdata('correo');
		$token = $CI->session->userdata('token');
		
		$CI->load->model('app/Login_model');
		$login = $CI->Login_model->check_token( $idUsuario, $correo, $token);
		
		/*echo "<pre>";
		var_dump($login, $idUsuario, $correo, $token);
		die();
		*/
		
		if($login){
			
			return true;
			
		}else{
			$CI->session->set_flashdata(
                    'message',
                    '<h3> <i class="fas fa-exclamation-triangle"></i> Acceso Restringido</h3> Por favor inicia sesión para continuar'
                );
                $CI->session->set_flashdata('message_type', 'danger');
                redirect(base_url('login'));
			
		}
		

	}
	
	
	
}




if (!function_exists('update_user_estatus')) {
    /**
     * Actualizamos el estatus del usuario en cada petición a un controlador
     * @param  int  $id_usuario id del usuario con sesion activa
     * @return void             actualizamos el estatus de la sesion en la lista
     *                          de sesiones (userData)
     */
    function update_user_estatus($id_usuario)
    {
        $CI = &get_instance();
        $CI->load->model('app/auth_model');
        $CI->session->set_userdata('estatus', $CI->auth_model->get_estatus_by_user_id($id_usuario));
    }
}

if (!function_exists('fuchi_wakala')) {
    /**
     * Eliminamos las sesiones y direccionamos al login
     * @return void retornamos al inicio sin sesiones
     */
    function fuchi_wakala($redir = true)
    {
        $CI = &get_instance();
        $CI->session->sess_destroy();
        $CI->session->set_flashdata(
            'message','<h3> <i class="fas fa-exclamation-triangle"></i> Acceso Restringido</h3> Por favor inicia sesión para continuar'
        );
        $CI->session->set_flashdata('message_type', 'danger');
		

        if ($redir) {
            redirect(base_url('login'), 'refresh');
        }
    }
}


if (!function_exists('fuchi_wakala2')) {
    /**
     * Eliminamos las sesiones y direccionamos al login
     * @return void retornamos al inicio sin sesiones
     */
    function fuchi_wakala2($redir = true)
    {
        $CI = &get_instance();
        $CI->session->sess_destroy();

        if ($redir) {
            redirect(base_url('store/'), 'refresh');
        }
    }
}




if (!function_exists('get_permiso_modulo_seccion')) {
    /**
     * Definimos si el usuario tiene acceso a ese modulo / sección
     * @param  int      $estatus_id estatus del usuario
     * @param  int      $rol_id     rol del usuario
     * @param  String   $elem_type  tipo de acceso (modulo o sección)
     * @param  id       $elem_id    id del elemento a acceder (modulo o sección)
     * @param  boolean  $finish     indica si al no tener el permiso finalizamos
     *                              la sesión
     * @return int?NULL             En caso de contar con el permiso retornamos
     *                              el identificador del permiso, de lo contrario
     *                              retornamos NULL
     */
    function get_permiso_modulo_seccion(
        $estatus_id,
        $rol_id,
		$idP,
        $modulo,
        $seccion_id,
        $finish = true
    ) {
        if ($estatus_id == 1 || $estatus_id == 2) {
            $CI = &get_instance();
            $CI->load->model('app/auth_model');
            $permiso_id = $CI->auth_model->get_permiso_modulo(
                $rol_id,
				$idP,
                $modulo,
                $seccion_id
            );
             if (is_null($permiso_id)) {
                if ($finish) {
                    redirect(base_url()."web");
                } else {
                    return null;
                }
            } else {
                return $permiso_id;
            }
        } else {
            redirect(base_url()."web");
        }
    }
}






if (!function_exists('get_role_permission')) {
    /**
     * Definimos si el usuario tiene acceso a ese modulo / sección
     * @param  int      $estatus_id estatus del usuario
     * @param  int      $rol_id     rol del usuario
     * @param  String   $elem_type  tipo de acceso (modulo o sección)
     * @param  id       $elem_id    id del elemento a acceder (modulo o sección)
     * @param  boolean  $finish     indica si al no tener el permiso finalizamos
     *                              la sesión
     * @return int?NULL             En caso de contar con el permiso retornamos
     *                              el identificador del permiso, de lo contrario
     *                              retornamos NULL
     */
    function get_role_permission(
        $estatus_id,
        $rol_id,
        $elem_type,
        $elem_id,
        $finish = true
    ) {
        if ($estatus_id == 1 || $estatus_id == 2) {
            $CI = &get_instance();
            $CI->load->model('app/auth_model');
            $permiso_id = $CI->auth_model->get_role_permission_in_module_section(
                $rol_id,
                $elem_type,
                $elem_id
            );
            if (is_null($permiso_id)) {
                if ($finish) {
                    fuchi_wakala();
                } else {
                    return null;
                }
            } else {
                return $permiso_id;
            }
        } else {
            fuchi_wakala();
        }
    }
}

if (!function_exists('get_section_module_data')) {
    /**
     * Retornamos la info del módulo o seccion del id dado
     * @param  String   $elem_type  tipo de acceso (modulo o sección)
     * @return Object               Objeto con los datos de la sección
     */
    function get_section_module_data($elem_type, $elem_id)
    {
        $CI = &get_instance();
        $CI->load->model('app/auth_model');
        return $CI->auth_model->get_section_module_data($elem_type, $elem_id);
    }
}

if (!function_exists('get_module_data_by_sec')) {
    /**
     * Retornamos la info del módulo del id dado
     * @param  int      $seccion_id id del la sección dada
     * @return Object               Objeto con los datos del módulo
     */
    function get_module_data_by_sec($seccion_id)
    {
        $CI = &get_instance();
        $CI->load->model('app/auth_model');
        return $CI->auth_model->get_module_data_by_sec($seccion_id);
    }
}

if (!function_exists('get_role_menu')) {
    /**
     * Armamos el menu de modulo para el rol en cuestion
     * @param  int $rol_id            Rol del usuario actual
     * @param  int $active_module_id  Modulo en el que se encuentra
     * @param  int $active_seccion_id Seccion en la que se encuentra
     * @return String                 Cadena con el contenido HTML del menu
     *                                correspondiente al rol del usuario
     */
    function get_role_menu(
        // Id perfil 
        $rol_id,
        $active_modulo_id,
        $active_seccion_id = null
    ) {
        $CI = &get_instance();
		$idP = $CI->session->userdata('idPerfilUsuario');
		
        $CI->load->model('app/auth_model');
		
        $rol_id == 1 ? $rol_modules = $CI->auth_model->get_modules_by_roleSA() : $rol_modules = $CI->auth_model->get_modules_by_role($rol_id, $idP); 

        $menu_html = '';
        $submenu_html = '';
		
		
		
		
		
		
		if($rol_modules != null){
			
			
			$banderaInicio = 0;
			
			$banderaPerfil = 0;
			
			foreach ($rol_modules as $moduleInicio) {
				
				if($moduleInicio->modulo_id == 1){
					
					$banderaInicio == 1;	
				}
			}
			
			if($banderaInicio == 0 && $rol_id != 1 ){
					
					$menu_html .='
						<li'.($active_modulo_id == 1 ? ' class="active"': '').'>
						<a href="http://localhost/sdi_web/web"><i class="
						fas fa-home "></i>
						Inicio                 
						</a>
						</li>
					';
				}
			
			
				foreach ($rol_modules as $moduleInicio) {
				
				if($moduleInicio->modulo_id == 4){
					
					$banderaPerfil == 1;	
				}
			}
			
			
				if($banderaPerfil == 0 && $rol_id != 1 ){
					
					$menu_html .='
						<li'.($active_modulo_id == 4 ? ' class="active"': '').'>
						<a href="http://localhost/sdi_web/daniw/Perfil_usuario/">
						<i class="fa fa-user-circle"></i>
						Perfil</a>
						</li>
					';
				}
			
			
		

			foreach ($rol_modules as $module) {
				$menu_html .=
					'
				<li' .
					((int) $module->modulo_id == $active_modulo_id
						? ' class="active"'
						: null) .
					'>
				<a href="' .


					(is_null($module->url_mod)
						? '#module-' . $module->modulo_id
						: base_url($module->url_mod)) .
					'"><i class="
				' .
					$module->ico_mod .
					' "></i>
				' .
					$module->nombre_mod .
					'                 
				</a>
				</li>
				';

				if (is_null($module->url_mod)) {

					$rol_id == 1 ? $sections_module = $CI->auth_model->get_module_sections_by_roleSA($module->modulo_id) : $sections_module = $CI->auth_model->get_module_sections_by_role($rol_id,
						$module->modulo_id, $idP
					);

					if (!is_null($sections_module)) {
						$submenu_html .=
							'<ul class="list-unstyled" data-link="module-' .
							$module->modulo_id .
							'">';

						foreach ($sections_module as $section) {
							if (!is_null($section->url_sec)) :
								$submenu_html .=
									'<li ' .
									((int) $section->seccion_id ==
										$active_seccion_id
										? ' class="active"'
										: null) .
									'>';
								$submenu_html .=
									'<a href="' .
									base_url($section->url_sec) .
									'" ><i class="
								' .
									$section->ico_sec .
									' "></i><span class="d-inline-block">' .
									$section->nombre_sec .
									'</span>
								</a>';
							else :
								$submenu_html .=
									'<li' .
									((int) $section->seccion_id ==
										$active_seccion_id
										? ' class="active"'
										: null) .
									' style="    margin-left: 5px !important;">';
								$submenu_html .=
									'<a style="cursor: text !important;"><strong>' .
									$section->ico_sec .
									' <span class="d-inline-block">' .
									$section->nombre_sec .
									'</span></strong></a>';
							endif;
							$submenu_html .= '</li>';
						}

						$submenu_html .= '</ul>';
					}else{
						 $submenu_html .= '<ul class="list-unstyled" data-link="module-' .
							$module->modulo_id .
							'"><li></li></ul>';
					}


				}
			}
			
			
			$banderaFin = 0;
			
			foreach ($rol_modules as $moduleFin) {
				
				if($moduleFin->modulo_id == 2){
					
					$banderaFin == 1;	
				}
			}
			
			if($banderaFin == 0 && $rol_id != 1){
					
					$menu_html .='
						<li'.($active_modulo_id == 2 ? ' class="active"': '').'>
						<a href="http://localhost/sdi_web/logout"><i class="
						fas fa-power-off "></i>
						Cerrar sesión                 
						</a>
						</li>
					';
				}
			
			
			
		}else{
			
			
			$menu_html .='
				<li'.($active_modulo_id == 1 ? ' class="active"': '').'>
				<a href="http://localhost/sdi_web/web"><i class="
				fas fa-home "></i>
				Inicio                 
				</a>
				</li>
				<li'.($active_modulo_id == 4 ? ' class="active"': '').'>
						<a href="http://localhost/sdi_web/daniw/Perfil_usuario/">
						<i class="fa fa-user-circle"></i>
						Perfil</a>
						</li>
				<li'.($active_modulo_id == 2 ? ' class="active"': '').'>
				<a href="http://localhost/sdi_web/logout"><i class="
				fas fa-power-off "></i>
				Cerrar sesión                 
				</a>
				</li>
			';
			
		}

        return ['menu' => $menu_html, 'submenu' => $submenu_html];
    }
}





// if (!function_exists('get_role_menu2')) {
//     /**
//      * Armamos el menu de modulo para el rol en cuestion
//      * @param  int $rol_id            Rol del usuario actual
//      * @param  int $active_module_id  Modulo en el que se encuentra
//      * @param  int $active_seccion_id Seccion en la que se encuentra
//      * @return String                 Cadena con el contenido HTML del menu
//      *                                correspondiente al rol del usuario
//      */
//     function get_role_menu2(
//         $rol_id,
//         $active_modulo_id,
//         $active_seccion_id = null
//     ) {
//         $CI = &get_instance();
//         $CI->load->model('app/auth_model');
//         $rol_modules = $CI->auth_model->get_modules_by_role($rol_id);

//         $menu_html = '';
//         $submenu_html = '';

//         foreach ($rol_modules as $module) {
//             $menu_html .=
//                 '
//             <li' .
//                 ((int) $module->modulo_id == $active_modulo_id
//                     ? ' class="active"'
//                     : null) .
//                 '>
//             <a href="' .
//                 (is_null($module->url_mod)
//                     ? '#module-' . $module->modulo_id
//                     : base_url($module->url_mod)) .
//                 '">
//             ' .
//                 $module->ico_mod .
//                 '
//             ' .
//                 $module->nombre_mod .
//                 '                 
//             </a>
//             </li>
//             ';

//             if (is_null($module->url_mod)) {
//                 $sections_module = $CI->auth_model->get_module_sections_by_role(
//                     $rol_id,
//                     $module->modulo_id
//                 );

//                 if (!is_null($sections_module)) {
//                     $submenu_html .=
//                         '<ul class="list-unstyled" data-link="module-' .
//                         $module->modulo_id .
//                         '">';

//                     foreach ($sections_module as $section) {
//                         if (!is_null($section->url_sec)) :
//                             $submenu_html .=
//                                 '<li ' .
//                                 ((int) $section->seccion_id ==
//                                     $active_seccion_id
//                                     ? ' class="active"'
//                                     : null) .
//                                 '>';
//                             $submenu_html .=
//                                 '<a href="' .
//                                 base_url($section->url_sec) .
//                                 '" >
//                             ' .
//                                 $section->ico_sec .
//                                 ' <span class="d-inline-block">' .
//                                 $section->nombre_sec .
//                                 '</span>
//                             </a>';
//                         else :
//                             $submenu_html .=
//                                 '<li' .
//                                 ((int) $section->seccion_id ==
//                                     $active_seccion_id
//                                     ? ' class="active"'
//                                     : null) .
//                                 ' style="    margin-left: 5px !important;">';
//                             $submenu_html .=
//                                 '<a style="cursor: text !important;"><strong>' .
//                                 $section->ico_sec .
//                                 ' <span class="d-inline-block">' .
//                                 $section->nombre_sec .
//                                 '</span></strong></a>';
//                         endif;
//                         $submenu_html .= '</li>';
//                     }

//                     $submenu_html .= '</ul>';
//                 }
//             }
//         }

//         return ['menu' => $menu_html, 'submenu' => $submenu_html];
//     }
// }







if (!function_exists('can_i_add')) {
    /**
     * Revisamos si tenemos el permiso para agregar en la sección donde se encuentre
     * @param  int $permiso_id        Permiso del rol del usuario
     *                                para la sección
     * @return Boolean
     */
    function can_i_add($permiso_id)
    {
        return $permiso_id == 2 || $permiso_id == 3 || $permiso_id == 4
            ? true
            : false;
    }
}

if (!function_exists('can_i_edit')) {
    /**
     * Revisamos si tenemos el permiso para editar en la sección donde se encuentre
     * @param  int $permiso_id        Permiso del rol del usuario
     *                                para la sección
     * @return Boolean
     */
    function can_i_edit($permiso_id)
    {
        return $permiso_id == 3 || $permiso_id == 4 ? true : false;
    }
}

if (!function_exists('can_i_remove')) {
    /**
     * Revisamos si tenemos el permiso para editar en la sección donde se encuentre
     * @param  int $permiso_id        Permiso del rol del usuario
     *                                para la sección
     * @return Boolean
     */
    function can_i_remove($permiso_id)
    {
        return $permiso_id == 4 ? true : false;
    }
}

if (!function_exists('var_dump_format')) {
    /**
     * Retornamos un var_dump formateado
     */
    function var_dump_format($expression)
    {
        echo '<pre>';
        var_dump($expression);
        echo '</pre>';
    }
}

if (!function_exists('send_mail')) {
    function send_mail(
        $user_send,
        $to_email,
        $asunto,
        $html = '',
        $attach = null
    ) {
        $CI = &get_instance();
        $CI->load->library('email', null, 'ci_email');

        /*$config['mailpath'] = '/usr/sbin/sendmail';*/
        $config['protocol'] = 'SMTP';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = true;
        $config['smtp_host'] = 'shared196.accountservergroup.com';
        $config['smtp_user'] = 'contacto_web@localhost/sdi_web';
        $config['smtp_pass'] = 'SOi?&Nmzv2![';
        $config['smtp_port'] = 465;
        $config['smtp_crypto'] = 'tls';
        $config['mailtype'] = 'html';
        $config['newline'] = "\r\n";
        $config['crlf'] = "\r\n";
        $CI->ci_email->initialize($config);

        $from_email = 'contacto_web@localhost/sdi_web';

        $CI->ci_email->from($to_email, $user_send);
        $CI->ci_email->to($from_email);
        $CI->ci_email->subject($asunto);
        if (!is_null($attach)) {
            // var_dump($attach);
            $CI->ci_email->attach($attach);
        }
        $CI->ci_email->message($html);
        $CI->ci_email->send();
        /*var_dump_format($CI->ci_email->print_debugger());*/
    }
}
if (!function_exists('send_mail2')) {
    function send_mail2(
        $user_send,
        $to_email,
        $asunto,
        $html = '',
        $attach = null
    ) {
        $CI = &get_instance();
        $CI->load->library('email', null, 'ci_email');

        /*$config['mailpath'] = '/usr/sbin/sendmail';*/
        $config['protocol'] = 'SMTP';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = true;
        $config['smtp_host'] = 'shared196.accountservergroup.com';
        $config['smtp_user'] = 'no_responder@localhost/sdi_web';
        $config['smtp_pass'] = 'uq@L=J5SmpRb';
        $config['smtp_port'] = 465;
        $config['smtp_crypto'] = 'tls';
        $config['mailtype'] = 'html';
        $config['newline'] = "\r\n";
        $config['crlf'] = "\r\n";
        $CI->ci_email->initialize($config);

        $from_email = 'no_responder@localhost/sdi_web';

        $CI->ci_email->from($from_email, $user_send);
        $CI->ci_email->to($to_email);
        $CI->ci_email->subject($asunto);
        if (!is_null($attach)) {
            // var_dump($attach);
            $CI->ci_email->attach($attach);
        }
        $CI->ci_email->message($html);

        $enviado = $CI->ci_email->send(); // captura el valor de retorno de la función send()

        return $enviado; 
        /*var_dump_format($CI->ci_email->print_debugger());*/
    }
}


if (!function_exists('get_historic_invoice_complements')) {
    /**
     * [get_invoice_complements description]
     * @param  [type] $IdFac [description]
     * @return [type]        [description]
     */
    function get_historic_invoice_complements($IdFac)
    {
        $CI = &get_instance();
        $CI->load->model('invoice_model');

        return $CI->invoice_model->get_historic_complements($IdFac);
    }
}

if (!function_exists('get_historic_invoice_creditnotes')) {
    /**
     * [get_invoice_creditnotes description]
     * @param  [type] $IdFac [description]
     * @return [type]        [description]
     */
    function get_historic_invoice_creditnotes($IdFac)
    {
        $CI = &get_instance();
        $CI->load->model('invoice_model');

        return $CI->invoice_model->get_historic_creditnotes($IdFac);
    }
}

if (!function_exists('get_historic_carrinvoice_complements')) {
    /**
     * [get_historic_carrinvoice_complements description]
     * @param  [type] $idR [description]
     * @return [type]      [description]
     */
    function get_historic_carrinvoice_complements($idR)
    {
        $CI = &get_instance();
        $CI->load->model('carrinvoice_model');

        return $CI->carrinvoice_model->get_historic_carrinvoice_compl($idR);
    }
}

if (!function_exists('get_complements_invoice_losn')) {
    /**
     * [get_complements_invoice_losn description]
     * @param  [type] $IdRef [description]
     * @return [type]        [description]
     */
    function get_complements_invoice_losn($IdRef)
    {
        $CI = &get_instance();
        $CI->load->model('invoice_model');

        return $CI->invoice_model->get_complements_invoice_losn($IdRef);
    }
}

if (!function_exists('get_creditnotes_invoice_losn')) {
    /**
     * [get_creditnotes_invoice_losn description]
     * @param  [type] $IdRef [description]
     * @return [type]        [description]
     */
    function get_creditnotes_invoice_losn($IdRef)
    {
        $CI = &get_instance();
        $CI->load->model('invoice_model');

        return $CI->invoice_model->get_creditnotes_invoice_losn($IdRef);
    }
}

if (!function_exists('paginacion')) {
    function paginacion(
        $url = '',
        $registroActual = 0,
        $numeroRegistrosPorPagina = 10,
        $consulta = '',
        $total = 0
    ) {
        $linksPaginas = '';

        if ($registroActual > $total) {
            $registroActual = $total;
        }

        if ($numeroRegistrosPorPagina <= 0) {
            $numeroRegistrosPorPagina = 10;
        }

        // Siempre se van a mostrar máximo 10 numeros de página
        $cantidadPaginas = intval($total) / $numeroRegistrosPorPagina;

        $botonInicio = 0;
        $botonFinal = intval($cantidadPaginas) * $numeroRegistrosPorPagina;
        if ($botonFinal >= $total) {
            $botonFinal =
                (intval($cantidadPaginas) - 1) * $numeroRegistrosPorPagina;
        }

        $paginaActual = $registroActual / $numeroRegistrosPorPagina;

        // Siempre se van a mostrar máximo 10 numeros de página
        $botonAnterior = 0;
        if ($paginaActual > 1) {
            $botonAnterior =
                $paginaActual * $numeroRegistrosPorPagina -
                $numeroRegistrosPorPagina;
        }

        // Siempre se van a mostrar máximo 10 numeros de página
        $botonSiguiente = intval($cantidadPaginas) * $numeroRegistrosPorPagina;
        if ($paginaActual < intval($cantidadPaginas)) {
            $botonSiguiente =
                $paginaActual * $numeroRegistrosPorPagina +
                $numeroRegistrosPorPagina;
        }

        if ($botonSiguiente > $botonFinal) {
            $botonSiguiente = $botonFinal;
        }

        // Siempre se van a mostrar máximo 10 numeros de página
        if ($cantidadPaginas > 0 && $cantidadPaginas <= 10) {
            $inicioFor = 0;
            $finFor = $cantidadPaginas;
        } elseif ($cantidadPaginas > 10 && $paginaActual <= 5) {
            $inicioFor = 0;
            $finFor = 10;
        } elseif ($cantidadPaginas > 10 && $paginaActual > 5) {
            $inicioFor = $paginaActual - 5;
            $finFor = $paginaActual + 5;
            if ($finFor > $cantidadPaginas) {
                $finFor = $cantidadPaginas;
            }
        } else {
            $inicioFor = 0;
            $finFor = 0;
        }
        /*  
        echo "Inicio for $inicioFor  Fin for $finFor Número de registros por p&aacute;gina $numeroRegistrosPorPagina
              Total $total Cantidad $cantidadPaginas P&aacute;gina actual $paginaActual<br/>";
        */

        if ($cantidadPaginas > 0) {
            // se verifica que haya mas de una pagina

            $linksPaginas = "
                <ul class='pagination justify-content-center'>
                    <li class='page-item'><a class='page-link' href='$url/$botonInicio/$numeroRegistrosPorPagina/$consulta'> Inicio </a></li>
                    <li class='page-item'><a class='page-link' href='$url/$botonAnterior/$numeroRegistrosPorPagina/$consulta'> &laquo;</a></li>";

            for ($i = $inicioFor; $i < $finFor; $i++) {
                if ($paginaActual != $i) {
                    $linksPaginas .=
                        "<li class='page-item'><a class='page-link' href='$url/" .
                        intval($i * $numeroRegistrosPorPagina) .
                        "/$numeroRegistrosPorPagina/$consulta'>" .
                        intval($i + 1) .
                        '</a></li>';
                } else {
                    $linksPaginas .=
                        "<li class='page-item active'><a class='page-link' href='$url/" .
                        intval($i * $numeroRegistrosPorPagina) .
                        "/$numeroRegistrosPorPagina/$consulta'>" .
                        intval($i + 1) .
                        '</a></li>';
                }
            }

            $linksPaginas .= "
                    <li class='page-item'><a class='page-link' href='$url/$botonSiguiente/$numeroRegistrosPorPagina/$consulta'>  &raquo;</a></li>
                    <li class='page-item'><a class='page-link' href='$url/$botonFinal/$numeroRegistrosPorPagina/$consulta'> Fin </a></li>
                </ul>";
        }

        return $linksPaginas;
    }
}

if (!function_exists('selecciona')) {
    function selecciona($variable, $valor)
    {
        //die("$variable $valor");
        if ($variable == $valor) {
            return 'selected="selected"';
        }
        return '';
    }
}

if (!function_exists('checked_form')) {
    function checked_form($variable, $valor)
    {
        //die("$variable $valor");
        if ($variable == $valor) {
            return 'checked="checked"';
        }
        return '';
    }
}

if (!function_exists('validaAlfanumericoAcentosEspacio')) {
    function validaAlfanumericoAcentosEspacio($variable)
    {
        if (preg_match('[a-zA-Z áéíóúÁÉÍÓÚñÑ]', $texto)) {
            return true;
        }
        return false;
    }
}
