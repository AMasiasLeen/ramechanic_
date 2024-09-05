import $ from 'jquery';


import './bootstrap';
import './aside_menu';
import Swal from 'sweetalert2';
window.Swal = Swal;

window.$ = window.jQuery = $;

import select2 from "select2";
select2();
