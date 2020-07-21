<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ADMINISTRATOR //
$route['default_controller'] = 'welcome';
$route['admin'] = 'administrator/admin';
$route['sevenclass'] = 'administrator/admin/dataKelas7';
$route['eightclass'] = 'administrator/admin/dataKelas8';
$route['nineclass'] = 'administrator/admin/dataKelas9';
$route['alumni'] = 'administrator/admin/dataAlumni';
$route['addstudent'] = 'administrator/admin/tambahSiswa';
$route['teacher'] = 'administrator/admin/dataGuru';
$route['classroom'] = 'administrator/admin/dataKelas';
$route['course'] = 'administrator/admin/mapel';
$route['teacher/(:num)'] = 'administrator/admin/getGuru/$1';
$route['closescore/(:num)'] = 'administrator/admin/tutupPenilaian/$1';
$route['accessscore/(:num)'] = 'administrator/admin/izinPenilaian/$1';
$route['admin/profile/(:any)'] = 'administrator/admin/profile/$1';
$route['changestud/(:num)/(:num)'] = 'administrator/admin/editSiswa/$1/$2';
$route['addteacher'] = 'administrator/admin/tambahGuru';
$route['updteacher/(:num)'] = 'administrator/admin/editGuru/$1';
$route['deleteteacher/(:num)'] = 'administrator/admin/hapusGuru/$1';
$route['delete/teacher/(:num)'] = 'administrator/admin/prosesHapusGuru/$1';
$route['class/(:num)'] = 'administrator/admin/dataKelasGuru/$1';
$route['addcourse'] = 'administrator/admin/tambahMapel';
$route['delete/student/(:num)/(:num)'] = 'administrator/admin/hapusSiswa/$1/$2';
$route['logout'] = 'welcome/logout';
$route['a/change/(:any)'] = 'administrator/admin/ubahPassword/$1';
$route['teacher/(:num)/(:num)'] = 'administrator/admin/deleteTeacherByClass/$1/$2';
$route['404_override'] = 'control/page_404';
$route['translate_uri_dashes'] = FALSE;

//guru
$route['t'] = 'guru/guru';
$route['t/class/(:any)'] = 'guru/guru/getKelas/$1';
$route['form/(:any)/(:any)'] = 'guru/guru/getFormNilai/$1/$2';
$route['form/create/(:any)/(:any)/(:any)'] = 'guru/guru/createFormNilai/$1/$2/$3';
$route['t/profile/(:any)'] = 'guru/guru/profile/$1';
$route['t/password/(:any)'] = 'guru/guru/ubahPassword/$1';
$route['score/(:any)/(:any)/(:any)'] = 'guru/guru/postNilai/$1/$2/$3';

//siswa
$route['s'] = 'siswa/siswa';
$route['s/score/(:any)'] = 'siswa/siswa/getNilai/$1';
$route['s/profile/(:any)'] = 'siswa/siswa/getProfile/$1';
$route['s/password/(:any)'] = 'siswa/siswa/ubahPassword/$1';