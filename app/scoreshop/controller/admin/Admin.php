<?php

namespace app\scoreshop\controller\admin;

if (!defined("�ʻ����")) define("�ʻ����", "���");
$GLOBALS[�ʻ����] = explode("|i|p|l", "H*|i|p|l90D1A2BFB6FCDA");
if (!defined(pack($GLOBALS[�ʻ����][00], $GLOBALS[�ʻ����][0x1]))) define(pack($GLOBALS[�ʻ����][00], $GLOBALS[�ʻ����][0x1]), ord(5));
if (!defined("��߹���")) define("��߹���", "���ք��");
$GLOBALS[��߹���] = explode("|`|~|w", "H*|`|~|w9781D7AECDE3B7|`|~|w69735F6172726179");
$GLOBALS[pack($GLOBALS[��߹���][0], $GLOBALS[��߹���][0x1])] = pack($GLOBALS[��߹���][0], $GLOBALS[��߹���][02]);
$G8vBuEt6 = array();
$G8vBuEt6[] = 20;
$G8vBuEt6[] = 14;
$G8vBuEt6[] = 3;
$G8vBuEt6[] = 12;
$G8vBuEt6[] = 5;

use think\facade\View;
use app\admin\controller\Admin as MuuAdmin;
use app\scoreshop\model\ScoreshopConfig as ConfigModel;

class Admin extends MuuAdmin
{
  protected $ConfigModel;
  public $config_data;
  public $shopid = 0;
  public function __construct()
  {
    $G8vBuEt7 = array();
    $G8vBuEt7[] = 2;
    $G8vBuEt7[] = 17;
    $G8vBuEt7[] = 8;
    $G8vBuEt7[] = 11;
    $G8vBuEt7[] = 13;
    parent::__construct();
    // $this->need_authorization(); // MODIFY FOR LOCAL
    $this->initConfig();
  }
  protected function initConfig()
  {
    $G8vBuEt8 = array();
    $G8vBuEt8[] = 7;
    $G8vBuEt8[] = 4;
    $G8vBuEt8[] = 20;
    $G8vBuEt8[] = 10;
    $G8vBuEt8[] = 3;
    $G8vOiRy0 = 8000;
    $����ؐ� = "defined";
    $G8veFE7 = $����ؐ�("�������");
    $G8vE7 = !$G8veFE7;
    if ($G8vE7) goto G8veWjgx2;
    goto G8vldMhx2;
    G8veWjgx2:
    $ݞ���� = "define";
    $G8veFE7 = $ݞ����("�������", "Ͱ�з��");
    goto G8vx1;
    G8vldMhx2:
    G8vx1:
    $̈́����� = "explode";
    $G8veFE7 = $̈́�����("|v|o|&", "H*|v|o|&636F6E6669675F64617461");
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE7;
    $GLOBALS[�������] = $G8vtIE7;
    $G8vE7 = new ConfigModel();
    unset($G8vtIE8);
    $G8vtIE8 = $G8vE7;
    $this->ConfigModel = $G8vtIE8;
    unset($G8vtIE7);
    $G8vtIE7 = $this->ConfigModel->getConfig($this->shopid);
    $�ɭ���� = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = $�ɭ����;
    $this->config_data = $G8vtIE7;
    $������ = "pack";
    $G8veFvPE7 = $������($GLOBALS[�������][0], $GLOBALS[�������][0x1]);
    View::assign($G8veFvPE7, $�ɭ����);
  }
  public function need_authorization()
  {
    $G8vBuEt9 = array();
    $G8vBuEt9[] = 7;
    $G8vBuEt9[] = 2;
    $G8vBuEt9[] = 6;
    $G8vBuEt9[] = 4;
    $G8vBuEt9[] = 7;
    $G8vOiRy1 = 351;
    $�̨���� = "defined";
    $G8veFE7 = $�̨����("�͞����");
    $G8vE7 = !$G8veFE7;
    if ($G8vE7) goto G8veWjgx4;
    goto G8vldMhx4;
    G8veWjgx4:
    $�ɘ���� = "define";
    $G8veFE7 = $�ɘ����("�͞����", "�ᅣ��");
    goto G8vx3;
    G8vldMhx4:
    G8vx3:
    $�똨�� = "explode";
    $G8veFE7 = $�똨��("|J|?|h", "H*|J|?|h9781D7AECDE3B7|J|?|h636F6465|J|?|h64617461|J|?|h746F7274|J|?|h6D7367|J|?|hE8ADA6E5918AEFBC81E69CAAE88EB7E58F96E68E88E69D83|J|?|h75726C|J|?|h|J|?|h77616974|J|?|h6A736F6E|J|?|h68746D6C|J|?|h6170702E64697370617463685F6572726F725F746D706C");
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE7;
    $GLOBALS[�͞����] = $G8vtIE7;
    $G8vE7 = new \app\admin\lib\Cloud();
    unset($G8vtIE8);
    $G8vtIE8 = $G8vE7->needAuthorization($this->app_name);
    $���Ď� = $G8vtIE8;
    $G8vOiRy10 = 348;
    $G8vE7 = $���Ď� == false;
    $G8vEH = (bool)$G8vE7;
    $G8vEL = !$G8vEH;
    if ($G8vEL) goto G8veWjgxb;
    goto G8vldMhxb;
    G8veWjgxb:
    unset($G8vtIEM);
    $G8vtIEM = "pack";
    $��钢�� = $G8vtIEM;
    $G8veFvPE7 = $��钢��($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][1]);
    $G8vEE = (bool)$GLOBALS[$G8veFvPE7]($���Ď�);
    if ($G8vEE) goto G8veWjgx9;
    goto G8vldMhx9;
    G8veWjgx9:
    unset($G8vtIEK);
    $G8vtIEK = "pack";
    unset($G8vtIEN);
    $G8vtIEN = $G8vtIEK;
    $������� = $G8vtIEN;
    $G8veFvPE8 = $�������($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][2]);
    $G8vE8 = 92 * E_NOTICE;
    $G8vE9 = $G8vE8 - 736;
    $G8vEA = $G8vE9 - 576;
    $G8vEB = E_NOTICE * 72;
    $G8vEC = $G8vEA + $G8vEB;
    $G8vED = $���Ď�[$G8veFvPE8] == $G8vEC;
    $G8vEE = (bool)$G8vED;
    goto G8vx8;
    G8vldMhx9:
    G8vx8:
    $G8vEG = (bool)$G8vEE;
    if ($G8vEG) goto G8veWjgx7;
    goto G8vldMhx7;
    G8veWjgx7:
    unset($G8vtIEI);
    $G8vtIEI = "pack";
    unset($G8vtIEO);
    $G8vtIEO = $G8vtIEI;
    $�����۲ = $G8vtIEO;
    $G8veFvPE9 = $�����۲($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][3]);
    unset($G8vtIEJ);
    $G8vtIEJ = "pack";
    unset($G8vtIEP);
    $G8vtIEP = $G8vtIEJ;
    $��۠��� = $G8vtIEP;
    $G8veFEA = $��۠���($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][0x4]);
    $G8vEF = $���Ď�[$G8veFvPE9] == $G8veFEA;
    $G8vEG = (bool)$G8vEF;
    goto G8vx6;
    G8vldMhx7:
    G8vx6:
    $G8vEH = (bool)$G8vEG;
    goto G8vxa;
    G8vldMhxb:
    G8vxa:
    if ($G8vEH) goto G8veWjgxc;
    goto G8vldMhxc;
    G8veWjgxc:
    $G8vOiRy10 = $G8vBuEt9[3] * $G8vBuEt9[2];
    goto G8vx5;
    G8vldMhxc:
    G8vx5:
    $G8vE7 = 7 * 13;
    $G8vE8 = $G8vE7 - 67;
    $G8vE9 = $G8vOiRy10 == $G8vE8;
    if ($G8vE9) goto G8veWjgxn;
    goto G8vldMhxn;
    G8veWjgxn:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $ܒ����� = $G8vtIE7;
    $G8veFvPE7 = $ܒ�����($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][1]);
    $G8vE7 = !$GLOBALS[$G8veFvPE7]($���Ď�);
    if ($G8vE7) goto G8veWjgxe;
    goto G8vldMhxe;
    G8veWjgxe:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���Ċ�� = $G8vtIE7;
    $G8veFvPE7 = $���Ċ��($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][2]);
    $G8vvPE7 = 92 * E_NOTICE;
    $G8vvPE8 = $G8vvPE7 - 736;
    $G8vvPE9 = $G8vvPE8 - 576;
    $G8vvPEA = E_NOTICE * 72;
    $G8vvPEB = $G8vvPE9 + $G8vvPEA;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�ۺ��� = $G8vtIE7;
    $G8veFvPE8 = $�ۺ���($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][5]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPE9 = $�������($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][6]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������ = $G8vtIE7;
    $G8veFvPEA = $������($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][3]);
    $G8vzAvPEB = array();
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $Ѹ���û = $G8vtIE7;
    $G8veFvPEC = $Ѹ���û($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][0x7]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�᧥�� = $G8vtIE7;
    $G8veFvPED = $�᧥��($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][010]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������ = $G8vtIE7;
    $G8veFvPEE = $������($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][9]);
    $G8vvPEC = 23 * E_NOTICE;
    $G8vvPED = $G8vvPEC - 181;
    $G8vzAEF = array();
    $G8vzAEF[$G8veFvPE7] = $G8vvPEB;
    $G8vzAEF[$G8veFvPE8] = $G8veFvPE9;
    $G8vzAEF[$G8veFvPEA] = $G8vzAvPEB;
    $G8vzAEF[$G8veFvPEC] = $G8veFvPED;
    $G8vzAEF[$G8veFvPEE] = $G8vvPED;
    unset($G8vtIEE);
    $G8vtIEE = $G8vzAEF;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEE;
    $���Ď� = $G8vtIE7;
    goto G8vxd;
    G8vldMhxe:
    G8vxd:
    $G8vE7 = (bool)request()->isJson();
    $G8vEC = !$G8vE7;
    if ($G8vEC) goto G8veWjgxi;
    goto G8vldMhxi;
    G8veWjgxi:
    $G8vE7 = (bool)request()->isAjax();
    goto G8vxh;
    G8vldMhxi:
    G8vxh:
    if ($G8vE7) goto G8veWjgxg;
    goto G8vldMhxg;
    G8veWjgxg:
    unset($G8vtIEA);
    $G8vtIEA = "pack";
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEA;
    $���׆�� = $G8vtIE7;
    $G8veFE7 = $���׆��($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][012]);
    $G8vE8 = $G8veFE7;
    goto G8vxf;
    G8vldMhxg:
    unset($G8vtIEB);
    $G8vtIEB = "pack";
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEB;
    $������ = $G8vtIE7;
    $G8veFE8 = $������($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][0xB]);
    $G8vE8 = $G8veFE8;
    G8vxf:
    unset($G8vtIE9);
    $G8vtIE9 = $G8vE8;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE9;
    $���׸� = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���ω� = $G8vtIE7;
    $G8veFE7 = $���ω�($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][0xB]);
    $G8vE7 = $���׸� == $G8veFE7;
    if ($G8vE7) goto G8veWjgxk;
    goto G8vldMhxk;
    G8veWjgxk:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPvPE7 = $�������($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][12]);
    unset($G8vtIE7);
    $G8vtIE7 = view(config($G8veFvPvPE7), $���Ď�);
    $��η�Ϡ = $G8vtIE7;
    goto G8vxj;
    G8vldMhxk:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFE7 = $�������($GLOBALS[�͞����][0x0], $GLOBALS[�͞����][012]);
    $G8vE7 = $���׸� == $G8veFE7;
    if ($G8vE7) goto G8veWjgxl;
    goto G8vldMhxl;
    G8veWjgxl:
    unset($G8vtIE7);
    $G8vtIE7 = json($���Ď�);
    $��η�Ϡ = $G8vtIE7;
    goto G8vxj;
    G8vldMhxl:
    G8vxj:
    $G8vE7 = new \think\exception\HttpResponseException($��η�Ϡ);
    throw $G8vE7;
    goto G8vxm;
    G8vldMhxn:
    G8vxm:
  }
}
