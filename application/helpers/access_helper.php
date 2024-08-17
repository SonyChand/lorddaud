<?php
defined('BASEPATH') or exit('No direct script access allowed');

function check_user_access()
{
    $access = get_instance();
    if (!$access->session->userdata('email')) {
        redirect('auth');
    } else {
        $user = $access->db->get_where('user', ['email' => $access->session->userdata('email')])->row();
        $uri = $access->uri->segment(1);
        $uri2 = $access->uri->segment(2);

        $menu = $access->db->get_where('user_menu', ['uri' => $uri])->row();

        $userMenu = $access->db->get_where('user_access_menu', [
            'user_id' => $user->id_user,
            'menu_id' => $menu->id_menu
        ]);
        if ($userMenu->num_rows() == 0) {
            redirect('auth/blocked');
        }

        if ($uri2 != null) {
            $submenu = $access->db->get_where('user_submenu', [
                'uri1' => $uri,
                'uri2' => $uri2
            ])->row();

            if ($submenu == false) {
                $userCrud = $access->db->get_where('user_crud_access', [
                    'user_id' => $user->id_user,
                    'menu_id' => $menu->id_menu,
                    'uri' => $uri2,
                ])->row();

                $userCrudAccess = $access->db->get_where('user_crud_access', [
                    'user_id' => $user->id_user,
                    'menu_id' => $menu->id_menu,
                    'submenu_id' => $userCrud->submenu_id,
                    'uri' => $uri2,
                ]);

                $userSubmenu = $access->db->get_where('user_access_submenu', [
                    'user_id' => $user->id_user,
                    'menu_id' => $menu->id_menu,
                    'submenu_id' => $userCrud->submenu_id
                ]);

                if ($userSubmenu->num_rows() == 0 || $userCrudAccess->num_rows() == 0) {
                    redirect('auth/blocked');
                }
            } else {
                $userSubmenu = $access->db->get_where('user_access_submenu', [
                    'user_id' => $user->id_user,
                    'menu_id' => $menu->id_menu,
                    'submenu_id' => $submenu->id_submenu
                ]);

                if ($userSubmenu->num_rows() == 0) {
                    redirect('auth/blocked');
                }
            }
        }
    }
}

function supreme()
{
    $access = get_instance();
    if (!$access->session->userdata('email') || $access->session->userdata('role_id') != 1) {
        redirect('dashboard');
    }
}

function super()
{
    $access = get_instance();
    if (!$access->session->userdata('email') || $access->session->userdata('role_id') > 2) {
        redirect('dashboard');
    }
}

function admin()
{
    $access = get_instance();
    if (!$access->session->userdata('email') || $access->session->userdata('role_id') > 3) {
        redirect('dashboard');
    }
}

function user()
{
    $access = get_instance();
    if (!$access->session->userdata('email')) {
        $access->session->set_flashdata('welcome', '<div class="alert alert-danger"><strong>Silahkan Login Terlebih Dahulu!!</strong></div>');
        redirect('auth');
    }
}

function sumput($email)
{
    $em   = explode("@", $email);
    $name = implode('@', array_slice($em, 0, count($em) - 1));
    $len  = floor(strlen($name) / 2);

    return substr($name, 0, $len) . str_repeat('*', $len) . "@" . end($em);
}

function perbedaan_waktu($waktu)
{
    $tes = date('Y-m-d H:i:s', time());
    $tes2 = date('Y-m-d H:i:s', $waktu);
    $awal  = date_create($tes2);
    $akhir = date_create($tes); // waktu sekarang
    $diff  = date_diff($awal, $akhir);

    if ($diff->d == 0) {
        if ($diff->h == 0) {
            if ($diff->i == 0) {
                $selisih = $diff->s . ' dtk';
            } else {
                $selisih = $diff->i . ' mnt';
            }
        } else {
            $selisih = $diff->h . ' jam';
        }
    } else {
        $selisih = $diff->days . ' hari';
    }

    echo $selisih;
    // $diff->y . ' tahun, ';
    // $diff->m . ' bulan, ';
    // $diff->d . ' hari, ';
    // $diff->h . ' jam, ';
    // $diff->i . ' menit, ';
    // $diff->s . ' detik, ';
}

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function maintain()
{
    $access = get_instance();
    if ($access->session->userdata('role') != 1) {
        $cek = $access->db->get_where('maintenance')->last_row();

        if ($cek == true) {


            if (time() > $cek->mulai && time() < $cek->akhir) {
                redirect('maintenance');
            }
        }
    }
}

function title($text)
{
    return preg_replace('/([A-Z])/', ' $1', $text);
}

function uriTitle()
{
    $access = get_instance();
    $text = ucwords($access->uri->segment(1));
    return $text;
}

function uriSubtitle()
{
    $access = get_instance();
    $text = ucwords($access->uri->segment(2));
    return $text;
}

function uri1()
{
    $access = get_instance();
    $uri = ucwords($access->uri->segment(1));
    return $uri;
}

function uri2()
{
    $access = get_instance();
    $uri = ucwords($access->uri->segment(2));
    return $uri;
}

function getAddCrudAccess()
{
    $access = get_instance();
    if (!$access->session->userdata('email')) {
        redirect('auth');
    } else {
        $user = $access->db->get_where('user', ['email' => $access->session->userdata('email')])->row();
        $uri = $access->uri->segment(1);
        $uri2 = $access->uri->segment(2);

        $menu = $access->db->get_where('user_menu', ['uri' => $uri])->row();

        $userMenu = $access->db->get_where('user_access_menu', [
            'user_id' => $user->id_user,
            'menu_id' => $menu->id_menu
        ]);

        if ($userMenu->num_rows() == 0) {
            redirect('auth/blocked');
        }

        if ($uri2 != null) {
            $submenu = $access->db->get_where('user_submenu', [
                'uri1' => $uri,
                'uri2' => $uri2
            ])->row();



            if ($submenu == true) {
                $userCrudAccess = $access->db->get_where('user_crud_access', [
                    'user_id' => $user->id_user,
                    'menu_id' => $menu->id_menu,
                    'submenu_id' => $submenu->id_submenu,
                    'action' => 'add',
                ]);
            }
        }
        return $userCrudAccess->num_rows();
    }
}

function getEditCrudAccess()
{
    $access = get_instance();
    if (!$access->session->userdata('email')) {
        redirect('auth');
    } else {
        $user = $access->db->get_where('user', ['email' => $access->session->userdata('email')])->row();
        $uri = $access->uri->segment(1);
        $uri2 = $access->uri->segment(2);

        $menu = $access->db->get_where('user_menu', ['uri' => $uri])->row();

        $userMenu = $access->db->get_where('user_access_menu', [
            'user_id' => $user->id_user,
            'menu_id' => $menu->id_menu
        ]);

        if ($userMenu->num_rows() == 0) {
            redirect('auth/blocked');
        }

        if ($uri2 != null) {
            $submenu = $access->db->get_where('user_submenu', [
                'uri1' => $uri,
                'uri2' => $uri2
            ])->row();



            if ($submenu == true) {
                $userCrudAccess = $access->db->get_where('user_crud_access', [
                    'user_id' => $user->id_user,
                    'menu_id' => $menu->id_menu,
                    'submenu_id' => $submenu->id_submenu,
                    'action' => 'edit',
                ]);
            }
        }
        return $userCrudAccess->num_rows();
    }
}

function getDeleteCrudAccess()
{
    $access = get_instance();
    if (!$access->session->userdata('email')) {
        redirect('auth');
    } else {
        $user = $access->db->get_where('user', ['email' => $access->session->userdata('email')])->row();
        $uri = $access->uri->segment(1);
        $uri2 = $access->uri->segment(2);

        $menu = $access->db->get_where('user_menu', ['uri' => $uri])->row();

        $userMenu = $access->db->get_where('user_access_menu', [
            'user_id' => $user->id_user,
            'menu_id' => $menu->id_menu
        ]);

        if ($userMenu->num_rows() == 0) {
            redirect('auth/blocked');
        }

        if ($uri2 != null) {
            $submenu = $access->db->get_where('user_submenu', [
                'uri1' => $uri,
                'uri2' => $uri2
            ])->row();



            if ($submenu == true) {
                $userCrudAccess = $access->db->get_where('user_crud_access', [
                    'user_id' => $user->id_user,
                    'menu_id' => $menu->id_menu,
                    'submenu_id' => $submenu->id_submenu,
                    'action' => 'delete',
                ]);
            }
        }
        return $userCrudAccess->num_rows();
    }
}

function getDownloadCrudAccess()
{
    $access = get_instance();
    if (!$access->session->userdata('email')) {
        redirect('auth');
    } else {
        $user = $access->db->get_where('user', ['email' => $access->session->userdata('email')])->row();
        $uri = $access->uri->segment(1);
        $uri2 = $access->uri->segment(2);

        $menu = $access->db->get_where('user_menu', ['uri' => $uri])->row();

        $userMenu = $access->db->get_where('user_access_menu', [
            'user_id' => $user->id_user,
            'menu_id' => $menu->id_menu
        ]);

        if ($userMenu->num_rows() == 0) {
            redirect('auth/blocked');
        }

        if ($uri2 != null) {
            $submenu = $access->db->get_where('user_submenu', [
                'uri1' => $uri,
                'uri2' => $uri2
            ])->row();



            if ($submenu == true) {
                $userCrudAccess = $access->db->get_where('user_crud_access', [
                    'user_id' => $user->id_user,
                    'menu_id' => $menu->id_menu,
                    'submenu_id' => $submenu->id_submenu,
                    'action' => 'download',
                ]);
            }
        }
        return $userCrudAccess->num_rows();
    }
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}

function histori($aksi, $oleh, $oleh2, $isi, $waktu, $warna)
{
    $akses = get_instance();
    $aktivitasUser = [
        'name_act' => $aksi,
        'act_by' => $oleh,
        'email_act' => $oleh2,
        'act_content' =>  $isi,
        'time_act' => $waktu,
        'act_color' => $warna,
    ];
    $akses->db->insert('histori_aktivitas', $aktivitasUser);
}

function tanggal_indonesia($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function tanggal_indonesia2($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function token($email, $tanggalSekarang)
{
    $access = get_instance();

    $initial = strtoupper(substr($email, 0, 1));
    $randomChar = strtoupper(str_shuffle($email));
    $randomTgl = strtoupper(str_shuffle($tanggalSekarang));
    $code = $initial . $randomChar . $randomTgl;
    $kode = substr(str_shuffle(md5($code)), 0, 8);

    $query = $access->db->get_where('user_token', ['token' => $kode, 'email' => $email]);
    if ($query->num_rows > 0) {
        return token($email, $tanggalSekarang);
    } else {
        return $kode;
    }
}

function kodeRM($name, $nik)
{
    $access = get_instance();

    $initial = strtoupper(substr($name, 0, 1));


    $randomChar = strtoupper(substr(str_shuffle(substr($name, 1)), 0, 1));

    $nikLastTwoDigits = substr($nik, -2);

    $defaultCode = '01';

    $code = $initial . $randomChar . '.' . $nikLastTwoDigits . '.' . $defaultCode;

    $query = $access->db->get_where('pasien', ['id_rm' => $code]);
    if ($query->num_rows > 0) {
        return kodeRM($name, $nik);
    } else {
        return $code;
    }
}

function invoiceKode($name, $noRM)
{
    $access = get_instance();

    $tanggalSekarang = date('YmdHis');

    // Gabungkan nama pasien, no RM, dan tanggal sekarang
    $acakNama = strtoupper(substr(str_shuffle($name), 0, 1));
    $acakNoRM = strtoupper(substr(str_shuffle($noRM), 0, 1));
    $kode =  $acakNama . $acakNoRM . $tanggalSekarang;

    $kode = md5($kode);

    // Ambil 10 digit pertama dari hasil hash
    $invoiceCode = substr($kode, 0, 10);

    $query = $access->db->get_where('pembayaran', ['invoice' => $invoiceCode]);
    if ($query->num_rows > 0) {
        return invoiceKode($name, $noRM);
    } else {
        return $invoiceCode;
    }
}

function money($money)
{
    $pulus = 'Rp. ' . number_format($money, 0, ',', '.');
    return $pulus;
}
function hideName($name)
{
    $words = explode(' ', $name);
    $hiddenName = '';
    foreach ($words as $word) {
        $hiddenName .= substr($word, 0, 1) . str_repeat('*', strlen($word) - 2) . substr($word, -1) . ' ';
    }
    return trim($hiddenName);
}

function hideNoRM($noRM)
{
    $words = explode(' ', $noRM);
    $hiddenName = '';
    foreach ($words as $word) {
        $hiddenName .= substr($word, 0, 1) . str_repeat('*', strlen($word) - 2) . substr($word, -1) . ' ';
    }
    return trim($hiddenName);
}


function hideNik($nik)
{
    $hiddenNik = substr($nik, 0, 3) . str_repeat('*', strlen($nik) - 6) . substr($nik, -3);
    return $hiddenNik;
}
