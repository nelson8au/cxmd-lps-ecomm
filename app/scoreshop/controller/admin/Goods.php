<?php

namespace app\scoreshop\controller\admin;

if (!defined("��҃Ʒ�")) define("��҃Ʒ�", "�����Ƒ");
$GLOBALS[��҃Ʒ�] = explode("|T|]|G", "H*|T|]|G9C9A96D3BCF8D3");
if (!defined(pack($GLOBALS[��҃Ʒ�][00], $GLOBALS[��҃Ʒ�][1]))) define(pack($GLOBALS[��҃Ʒ�][00], $GLOBALS[��҃Ʒ�][1]), ord(2));
if (!defined("�������")) define("�������", "���Ț��");
if (!defined('���Ӽ��')) define('���Ӽ��', 50); // MODIFY FOR LOCAL
$GLOBALS[�������] = explode("|s|H|/", "H*|s|H|/F091EEB4F7C490|s|H|/69735F6172726179|s|H|/BACEA7D4BFDEC0|s|H|/6578706C6F6465");
$GLOBALS[pack($GLOBALS[�������][0x0], $GLOBALS[�������][01])] = pack($GLOBALS[�������][0x0], $GLOBALS[�������][02]);
$GLOBALS[pack($GLOBALS[�������][0x0], $GLOBALS[�������][3])] = pack($GLOBALS[�������][0x0], $GLOBALS[�������][4]);
$G8vBuEt31 = array();
$G8vBuEt31[] = 13;
$G8vBuEt31[] = 18;
$G8vBuEt31[] = 2;
$G8vBuEt31[] = 10;
$G8vBuEt31[] = 14;

use app\admin\builder\AdminConfigBuilder;
use app\common\model\Brand;
use app\JieBaTokenizer;
use app\scoreshop\controller\admin\Admin as ScoreshopAdmin;
use app\scoreshop\logic\Goods as GoodsLogic;
use \app\scoreshop\logic\Attribute as AttributeLogic;
use app\scoreshop\model\ScoreshopAttribute as AttributeModel;
use app\scoreshop\model\ScoreshopGoods as GoodsModel;
use app\scoreshop\model\ScoreshopCategory as CategoryModel;
use app\scoreshop\validate\ScoreshopGoods;
use TeamTNT\TNTSearch\TNTSearch;
use think\exception\ValidateException;
use think\facade\Db;
use think\facade\View;

class Goods extends ScoreshopAdmin
{
  protected $CategoryModel;
  protected $AttributeLogic;
  protected $AttributeModel;
  protected $GoodsModel;
  protected $GoodsLogic;
  protected $DeliveryModel;

  function __construct()
  {
    $G8vBuEt32 = array();
    $G8vBuEt32[] = 11;
    $G8vBuEt32[] = 9;
    $G8vBuEt32[] = 5;
    $G8vBuEt32[] = 5;
    $G8vBuEt32[] = 7;
    parent::__construct();
    $G8vE7 = new GoodsLogic();
    unset($G8vtIE8);
    $G8vtIE8 = $G8vE7;
    $this->GoodsLogic = $G8vtIE8;
    $G8vE7 = new GoodsModel();
    unset($G8vtIE8);
    $G8vtIE8 = $G8vE7;
    $this->GoodsModel = $G8vtIE8;
    $G8vE7 = new CategoryModel();
    unset($G8vtIE8);
    $G8vtIE8 = $G8vE7;
    $this->CategoryModel = $G8vtIE8;
    $G8vE7 = new AttributeLogic();
    unset($G8vtIE8);
    $G8vtIE8 = $G8vE7;
    $this->AttributeLogic = $G8vtIE8;
    $G8vE7 = new AttributeModel();
    unset($G8vtIE8);
    $G8vtIE8 = $G8vE7;
    $this->AttributeModel = $G8vtIE8;
  }

  public function lists()
  {
    $G8vBuEt33 = array();
    $G8vBuEt33[] = 3;
    $G8vBuEt33[] = 7;
    $G8vBuEt33[] = 4;
    $G8vBuEt33[] = 6;
    $G8vBuEt33[] = 20;
    $G8vOiRy0 = 8003;
    $�ն���� = "defined";
    $G8veFE7 = $�ն����("��ȭʨ�");
    $G8vE7 = !$G8veFE7;
    if ($G8vE7) goto G8veWjgx2;
    goto G8vldMhx2;
    G8veWjgx2:
    $��Ɯ��� = "define";
    $G8veFE7 = $��Ɯ���("��ȭʨ�", "�������");
    goto G8vx1;
    G8vldMhx2:
    G8vx1:
    $ޓ��镳 = "explode";
    $G8veFE7 = $ޓ��镳("|U|D|y", "H*|U|D|yC9E4F5AD81F7B5|U|D|y646566696E65|U|D|yA985A69BC7DBA4|U|D|y6B6579776F7264|U|D|y|U|D|y74657874|U|D|y63617465676F72795F6964|U|D|y696E7476616C|U|D|y737461747573|U|D|y616C6C|U|D|y73686F706964|U|D|y3D|U|D|y7469746C65|U|D|y6C696B65|U|D|y25|U|D|y696E|U|D|y3C3E|U|D|y726F7773|U|D|y6F726465725F6669656C64|U|D|y6964|U|D|y6F726465725F74797065|U|D|y64657363|U|D|y20|U|D|y2A|U|D|y64617461|U|D|y68355F75726C|U|D|y68355C696E646578|U|D|y232F73636F726573686F702F70616765732F676F6F64732F64657461696C3F69643D|U|D|y70635F75726C|U|D|y73636F726573686F702F70632E476F6F64732F64657461696C|U|D|y73756363657373|U|D|y63617465676F72795F74726565|U|D|y7061676572|U|D|y6C69737473|U|D|yE59586E59381E58897E8A1A8|U|D|y5F5F666F72776172645F5F|U|D|y524551554553545F555249");
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE7;
    $GLOBALS[��ȭʨ�] = $G8vtIE7;
    $G8vOiRy1 = 8002;
    $������� = "pack";
    $G8veFvPE7 = $�������($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][1]);
    $��۷�� = "defined";
    $G8veFE8 = $��۷��($G8veFvPE7);
    $G8vE7 = !$G8veFE8;
    if ($G8vE7) goto G8veWjgx4;
    goto G8vldMhx4;
    G8veWjgx4:
    $��ޕ��� = "pack";
    $G8veFvPE7 = $��ޕ���($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][2]);
    $ժ���Δ = "pack";
    $G8veFvPE8 = $ժ���Δ($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][1]);
    $���ԯ� = "pack";
    $G8veFvPE9 = $���ԯ�($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][3]);
    call_user_func($G8veFvPE7, $G8veFvPE8, $G8veFvPE9);
    goto G8vx3;
    G8vldMhx4:
    G8vx3:
    $G8vzAE7 = array();
    $G8vzAE7[] = &$_SERVER;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vzAE7;
    $GLOBALS[�������] = $G8vtIE7;
    $ֈ���� = "pack";
    $G8veFvPE7 = $ֈ����($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][4]);
    $�霱��� = "pack";
    $G8veFvPE8 = $�霱���($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x5]);
    $���ɫ�� = "pack";
    $G8veFvPE9 = $���ɫ��($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x6]);
    unset($G8vtIE7);
    $G8vtIE7 = input($G8veFvPE7, $G8veFvPE8, $G8veFvPE9);
    $���١�� = $G8vtIE7;
    $������� = "pack";
    $G8veFvPE7 = $�������($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x7]);
    $�쫵Ȏ� = "pack";
    $G8veFvPE8 = $�쫵Ȏ�($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x5]);
    $遃���� = "pack";
    $G8veFvPE9 = $遃����($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x8]);
    unset($G8vtIE7);
    $G8vtIE7 = input($G8veFvPE7, $G8veFvPE8, $G8veFvPE9);
    $��ܼ��� = $G8vtIE7;
    $�֒���� = "pack";
    $G8veFvPE7 = $�֒����($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][011]);
    $������� = "pack";
    $G8veFvPE8 = $�������($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][012]);
    unset($G8vtIE7);
    $G8vtIE7 = input($G8veFvPE7, $G8veFvPE8);
    $���裝� = $G8vtIE7;
    $ɿ����� = "pack";
    $G8veFvPvPE7 = $ɿ�����($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][11]);
    $�򊏂�� = "pack";
    $G8veFvPvPE8 = $�򊏂��($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0xC]);
    $G8vzAvPE9 = array();
    $G8vzAvPE9[] = $G8veFvPvPE7;
    $G8vzAvPE9[] = $G8veFvPvPE8;
    $G8vzAvPE9[] = $this->shopid;
    $G8vzAEA = array();
    $G8vzAEA[] = $G8vzAvPE9;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vzAEA;
    $�뾴᧊ = $G8vtIE7;
    $G8vOiRy3 = 8019;
    $G8vE7 = !empty($���١��);
    if ($G8vE7) goto G8veWjgx6;
    goto G8vldMhx6;
    G8veWjgx6:
    $G8vOiRy3 = $G8vBuEt33[1] * $G8vBuEt33[1];
    goto G8vx5;
    G8vldMhx6:
    G8vx5:
    $G8vE7 = 6 * 15;
    $G8vE8 = $G8vE7 - 41;
    $G8vE9 = $G8vOiRy3 == $G8vE8;
    if ($G8vE9) goto G8veWjgx8;
    goto G8vldMhx8;
    G8veWjgx8:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $��Ճ��� = $G8vtIE7;
    $G8veFvPE7 = $��Ճ���($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][015]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPE8 = $�������($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][016]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�Ͽ�� = $G8vtIE7;
    $G8veFvPE9 = $�Ͽ��($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][15]);
    $G8vvPE7 = $G8veFvPE9 . $���١��;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������ = $G8vtIE7;
    $G8veFvPEA = $������($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][15]);
    $G8vvPE8 = $G8vvPE7 . $G8veFvPEA;
    $G8vzAEB = array();
    $G8vzAEB[] = $G8veFvPE7;
    $G8vzAEB[] = $G8veFvPE8;
    $G8vzAEB[] = $G8vvPE8;
    unset($G8vtIE9);
    $G8vtIE9 = $G8vzAEB;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE9;
    $�뾴᧊[] = $G8vtIE7;
    goto G8vx7;
    G8vldMhx8:
    G8vx7:
    $G8vOiRy6 = 8015;
    $G8vE7 = !empty($��ܼ���);
    if ($G8vE7) goto G8veWjgxa;
    goto G8vldMhxa;
    G8veWjgxa:
    $G8vOiRy6 = $G8vBuEt33[4] * $G8vBuEt33[0];
    goto G8vx9;
    G8vldMhxa:
    G8vx9:
    $G8vE7 = 20 * 20;
    $G8vE8 = $G8vE7 - 340;
    $G8vE9 = $G8vOiRy6 == $G8vE8;
    if ($G8vE9) goto G8veWjgxe;
    goto G8vldMhxe;
    G8veWjgxe:
    unset($G8vtIE7);
    $G8vtIE7 = $this->CategoryModel->yesParent($��ܼ���);
    $������� = $G8vtIE7;
    $G8vE7 = !empty($�������);
    if ($G8vE7) goto G8veWjgxc;
    goto G8vldMhxc;
    G8veWjgxc:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $����슥 = $G8vtIE7;
    $G8veFvPE7 = $����슥($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x7]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $ܑ���Ϫ = $G8vtIE7;
    $G8veFvPE8 = $ܑ���Ϫ($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][020]);
    $G8vzAE9 = array();
    $G8vzAE9[] = $G8veFvPE7;
    $G8vzAE9[] = $G8veFvPE8;
    $G8vzAE9[] = $�������;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vzAE9;
    $�뾴᧊[] = $G8vtIE7;
    goto G8vxb;
    G8vldMhxc:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�Ĝѯ� = $G8vtIE7;
    $G8veFvPE7 = $�Ĝѯ�($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x7]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $����� = $G8vtIE7;
    $G8veFvPE8 = $�����($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0xC]);
    $G8vzAE9 = array();
    $G8vzAE9[] = $G8veFvPE7;
    $G8vzAE9[] = $G8veFvPE8;
    $G8vzAE9[] = $��ܼ���;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vzAE9;
    $�뾴᧊[] = $G8vtIE7;
    G8vxb:
    goto G8vxd;
    G8vldMhxe:
    G8vxd:
    $G8vOiRy8 = 8001;
    $��䛉� = "pack";
    $G8veFE7 = $��䛉�($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][012]);
    $G8vE7 = $���裝� == $G8veFE7;
    if ($G8vE7) goto G8veWjgxg;
    goto G8vldMhxg;
    G8veWjgxg:
    $G8vOiRy8 = $G8vBuEt33[3] * $G8vBuEt33[1];
    goto G8vxf;
    G8vldMhxg:
    $G8vE7 = 26 * ���Ӽ��;
    $G8vE8 = $G8vE7 - 1300;
    $G8vE9 = $���裝� == $G8vE8;
    if ($G8vE9) goto G8veWjgxh;
    goto G8vldMhxh;
    G8veWjgxh:
    $G8vOiRy8 = $G8vBuEt33[2] * $G8vBuEt33[3];
    goto G8vxf;
    G8vldMhxh:
    $G8vOiRy8 = $G8vBuEt33[4] * $G8vBuEt33[2];
    G8vxf:
    $G8vE7 = 10 * 14;
    $G8vE8 = $G8vE7 - 60;
    $G8vE9 = $G8vOiRy8 == $G8vE8;
    if ($G8vE9) goto G8veWjgxj;
    goto G8vldMhxj;
    G8veWjgxj:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $��Ԍ��� = $G8vtIE7;
    $G8veFvPE7 = $��Ԍ���($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][011]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $����� = $G8vtIE7;
    $G8veFvPE8 = $�����($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0xC]);
    $G8vzAE9 = array();
    $G8vzAE9[] = $G8veFvPE7;
    $G8vzAE9[] = $G8veFvPE8;
    $G8vzAE9[] = $���裝�;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vzAE9;
    $�뾴᧊[] = $G8vtIE7;
    goto G8vxi;
    G8vldMhxj:
    $G8vE7 = 10 * 10;
    $G8vE8 = $G8vE7 - 76;
    $G8vE9 = $G8vOiRy8 == $G8vE8;
    if ($G8vE9) goto G8veWjgxk;
    goto G8vldMhxk;
    G8veWjgxk:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $쾫���� = $G8vtIE7;
    $G8veFvPE7 = $쾫����($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][011]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPE8 = $�������($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0xC]);
    $G8vzAE9 = array();
    $G8vzAE9[] = $G8veFvPE7;
    $G8vzAE9[] = $G8veFvPE8;
    $G8vzAE9[] = $���裝�;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vzAE9;
    $�뾴᧊[] = $G8vtIE7;
    goto G8vxi;
    G8vldMhxk:
    $G8vE7 = 1 * 20;
    $G8vE8 = $G8vE7 + 22;
    $G8vE9 = $G8vOiRy8 == $G8vE8;
    if ($G8vE9) goto G8veWjgxl;
    goto G8vldMhxl;
    G8veWjgxl:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $����� = $G8vtIE7;
    $G8veFvPE7 = $�����($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][011]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPE8 = $�������($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][021]);
    $G8vvPE7 = 26 * ���Ӽ��;
    $G8vvPE8 = $G8vvPE7 - 1300;
    $G8vvPE9 = $G8vvPE8 - 4399;
    $G8vvPEA = 88 * ���Ӽ��;
    $G8vvPEB = $G8vvPE9 + $G8vvPEA;
    $G8vvPEC = -1 * $G8vvPEB;
    $G8vzAE9 = array();
    $G8vzAE9[] = $G8veFvPE7;
    $G8vzAE9[] = $G8veFvPE8;
    $G8vzAE9[] = $G8vvPEC;
    unset($G8vtIED);
    $G8vtIED = $G8vzAE9;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIED;
    $�뾴᧊[] = $G8vtIE7;
    goto G8vxi;
    G8vldMhxl:
    G8vxi:
    $�ۈ���� = "pack";
    $G8veFvPE7 = $�ۈ����($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][022]);
    $G8vvPE7 = ���Ӽ�� * 86;
    $G8vvPE8 = $G8vvPE7 - 4285;
    $���ܓ�� = "pack";
    $G8veFvPE8 = $���ܓ��($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x8]);
    unset($G8vtIE9);
    $G8vtIE9 = input($G8veFvPE7, $G8vvPE8, $G8veFvPE8);
    $;����� = $G8vtIE9;
    $å�ԓ�� = "pack";
    $G8veFvPE7 = $å�ԓ��($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][19]);
    $�����ӫ = "pack";
    $G8veFvPE8 = $�����ӫ($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x14]);
    $ۘ��ˣ� = "pack";
    $G8veFvPE9 = $ۘ��ˣ�($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x6]);
    unset($G8vtIE7);
    $G8vtIE7 = input($G8veFvPE7, $G8veFvPE8, $G8veFvPE9);
    $����� = $G8vtIE7;
    $����݆� = "pack";
    $G8veFvPE7 = $����݆�($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][21]);
    $������ = "pack";
    $G8veFvPE8 = $������($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][026]);
    $������ = "pack";
    $G8veFvPE9 = $������($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x6]);
    unset($G8vtIE7);
    $G8vtIE7 = input($G8veFvPE7, $G8veFvPE8, $G8veFvPE9);
    $������ = $G8vtIE7;
    $��с歷 = "pack";
    $G8veFE7 = $��с歷($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][23]);
    $G8vE7 = $����� . $G8veFE7;
    $G8vE8 = $G8vE7 . $������;
    unset($G8vtIE9);
    $G8vtIE9 = $G8vE8;
    $������� = $G8vtIE9;
    $��ˇ��� = "pack";
    $G8veFvPE7 = $��ˇ���($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x18]);
    unset($G8vtIE7);
    $G8vtIE7 = $this->GoodsModel->getListByPage($�뾴᧊, $�������, $G8veFvPE7, $;�����);
    $����ឋ = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = $����ឋ->render();
    $�ʒ��Ĺ = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = $����ឋ->toArray();
    $����ឋ = $G8vtIE7;
    unset($G8vEc1);
    $G8vEc1 = array();
    foreach ($����ឋ[pack($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x19])] as &$�������) {
      $G8vEc1[] = &$�������;
    };
    $G8vOiRy12 = 8006;
    $����׵� = "pack";
    $G8veFvPvPE7 = $����׵�($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x19]);
    $ȁ����� = "is_array";
    $G8veFE8 = $ȁ�����($����ឋ[$G8veFvPvPE7]);
    if ($G8veFE8) goto G8veWjgxu;
    goto G8vldMhxu;
    G8veWjgxu:
    $G8vOiRy12 = $G8vBuEt33[1] * $G8vBuEt33[4];
    goto G8vxt;
    G8vldMhxu:
    G8vxt:
    $G8vE7 = 4 * 9;
    $G8vE8 = $G8vE7 + 104;
    $G8vE9 = $G8vOiRy12 == $G8vE8;
    if ($G8vE9) goto G8veWjgxw;
    goto G8vldMhxw;
    G8veWjgxw:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $苃��ϩ = $G8vtIE7;
    $G8veFvPE7 = $苃��ϩ($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x19]);
    unset($G8vtIE7);
    $G8vtIE7 = &$G8vEc1;
    $����ឋ[$G8veFvPE7] = &$G8vtIE7;
    goto G8vxv;
    G8vldMhxw:
    G8vxv:
    $G8v1i = 0;
    G8vxm:
    $���չ�� = "count";
    $G8veFE7 = $���չ��($G8vEc1);
    $G8vE7 = $G8v1i < $G8veFE7;
    $G8vOiRy10 = 8011;
    if ($G8vE7) goto G8veWjgxq;
    goto G8vldMhxq;
    G8veWjgxq:
    $G8vOiRy10 = $G8vBuEt33[0] * $G8vBuEt33[4];
    goto G8vxp;
    G8vldMhxq:
    G8vxp:
    $G8vE7 = 1 * 11;
    $G8vE8 = $G8vE7 + 49;
    $G8vE9 = $G8vOiRy10 == $G8vE8;
    if ($G8vE9) goto G8veWjgxs;
    goto G8vldMhxs;
    G8veWjgxs:
    $G8v1Key = array_keys($G8vEc1);
    $G8v1Key = $G8v1Key[$G8v1i];
    unset($G8vtIE7);
    $G8vtIE7 = &$G8vEc1[$G8v1Key];
    $������� = &$G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = $this->GoodsLogic->formatData($�������);
    $������� = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $��͙��� = $G8vtIE7;
    $G8veFvPE7 = $��͙���($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][26]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�ہ���� = $G8vtIE7;
    $G8veFvPE8 = $�ہ����($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][033]);
    $G8vzAvPE9 = array();
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $èЈ�� = $G8vtIE7;
    $G8veFEB = $èЈ��($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x1C]);
    $G8vE7 = url($G8veFvPE8, $G8vzAvPE9, true, true) . $G8veFEB;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $��ܽ�� = $G8vtIE7;
    $G8veFvPEC = $��ܽ��($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x14]);
    $G8vE8 = $G8vE7 . $�������[$G8veFvPEC];
    unset($G8vtIE9);
    $G8vtIE9 = $G8vE8;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE9;
    $�������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $Ͻπ��� = $G8vtIE7;
    $G8veFvPE7 = $Ͻπ���($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][29]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $刱䰯� = $G8vtIE7;
    $G8veFvPE8 = $刱䰯�($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][036]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������ = $G8vtIE7;
    $G8veFvPvPE9 = $������($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x14]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $����罯 = $G8vtIE7;
    $G8veFvPvPvPEA = $����罯($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x14]);
    $G8vzAvPEB = array();
    $G8vzAvPEB[$G8veFvPvPE9] = $�������[$G8veFvPvPvPEA];
    unset($G8vtIE7);
    $G8vtIE7 = url($G8veFvPE8, $G8vzAvPEB, true, true);
    $�������[$G8veFvPE7] = $G8vtIE7;
    G8vxn:
    $G8v1i = $G8v1i + 1;
    goto G8vxm;
    goto G8vxr;
    G8vldMhxs:
    G8vxr:
    G8vxo:
    unset($�������);
    $G8vOiRy14 = 8002;
    if (request()->isAjax()) goto G8veWjgxy;
    goto G8vldMhxy;
    G8veWjgxy:
    $G8vOiRy14 = $G8vBuEt33[0] * $G8vBuEt33[2];
    goto G8vxx;
    G8vldMhxy:
    G8vxx:
    $G8vE7 = 18 * 18;
    $G8vE8 = $G8vE7 - 312;
    $G8vE9 = $G8vOiRy14 == $G8vE8;
    if ($G8vE9) goto G8veWjgx11;
    goto G8vldMhx11;
    G8veWjgx11:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���ހ�� = $G8vtIE7;
    $G8veFvPE7 = $���ހ��($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x1F]);
    return $this->success($G8veFvPE7, $����ឋ);
    goto G8vxz;
    G8vldMhx11:
    G8vxz:
    $G8vvPE7 = 26 * ���Ӽ��;
    $G8vvPE8 = $G8vvPE7 - 1300;
    $G8vvPE9 = $G8vvPE8 - 4399;
    $G8vvPEA = 88 * ���Ӽ��;
    $G8vvPEB = $G8vvPE9 + $G8vvPEA;
    unset($G8vtIEC);
    $G8vtIEC = $this->CategoryModel->tree($this->shopid, $G8vvPEB);
    $ߘ��㖻 = $G8vtIEC;
    $���ó�� = "pack";
    $G8veFvPvPE7 = $���ó��($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][32]);
    $��Ñ��� = "pack";
    $G8veFvPvPE8 = $��Ñ���($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x7]);
    $������ = "pack";
    $G8veFvPvPE9 = $������($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][4]);
    $�ч��ر = "pack";
    $G8veFvPvPEA = $�ч��ر($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][041]);
    $���̤�� = "pack";
    $G8veFvPvPEB = $���̤��($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][34]);
    $G8vzAvPEC = array();
    $G8vzAvPEC[$G8veFvPvPE7] = $ߘ��㖻;
    $G8vzAvPEC[$G8veFvPvPE8] = $��ܼ���;
    $G8vzAvPEC[$G8veFvPvPE9] = $���١��;
    $G8vzAvPEC[$G8veFvPvPEA] = $�ʒ��Ĺ;
    $G8vzAvPEC[$G8veFvPvPEB] = $����ឋ;
    View::assign($G8vzAvPEC);
    $𔼉�� = "pack";
    $G8veFvPE7 = $𔼉��($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][35]);
    $this->setTitle($G8veFvPE7);
    $������� = "pack";
    $G8veFvPE7 = $�������($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][36]);
    $G8vvPvPE7 = 26 * ���Ӽ��;
    $G8vvPvPE8 = $G8vvPvPE7 - 1300;
    $����į = "pack";
    $G8veFvPvPE8 = $����į($GLOBALS[��ȭʨ�][00], $GLOBALS[��ȭʨ�][0x25]);
    // Cookie($G8veFvPE7, $GLOBALS[�������][$G8vvPvPE8][$G8veFvPvPE8]); // MODIFY FOR LOCAL
    return View::fetch();
  }

  public function edit()
  {
    $G8vBuEt34 = array();
    $G8vBuEt34[] = 3;
    $G8vBuEt34[] = 16;
    $G8vBuEt34[] = 4;
    $G8vBuEt34[] = 2;
    $G8vBuEt34[] = 4;
    $G8vOiRy15 = 4110;
    $ز����� = "defined";
    $G8veFE7 = $ز�����("ڽ�踤");
    $G8vE7 = !$G8veFE7;
    if ($G8vE7) goto G8veWjgx13;
    goto G8vldMhx13;
    G8veWjgx13:
    $������� = "define";
    $G8veFE7 = $�������("ڽ�踤", "��ڏ��");
    goto G8vx12;
    G8vldMhx13:
    G8vx12:
    $����䄽 = "explode";
    $G8veFE7 = $����䄽("|U|j|e", "H*|U|j|e6964|U|j|e696E7476616C|U|j|e706F73742E|U|j|e73686F706964|U|j|eE4BF9DE5AD98E68890E58A9FEFBC81|U|j|e|U|j|e5F5F666F72776172645F5F|U|j|eE4BF9DE5AD98E5A4B1E8B4A5|U|j|e74797065|U|j|e7469746C65|U|j|e6465736372697074696F6E|U|j|e636F766572|U|j|e63617465676F72795F6964|U|j|e6174747269627574655F696473|U|j|e7072696365|U|j|e736F7274|U|j|e737461747573|U|j|e726561736F6E|U|j|e665F76696577|U|j|e665F73616C6573|U|j|e665F6661766F7269746573|U|j|eE6B2A1E69C89E69FA5E8AFA2E588B0E79BB8E585B3E695B0E68DAE|U|j|e3D|U|j|e64617461|U|j|e63617465676F72795F74726565|U|j|e6174747269627574655F74726565|U|j|eE7BC96E8BE91|U|j|eE696B0E5A29E|U|j|eE59586E59381");
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE7;
    $GLOBALS[ڽ�踤] = $G8vtIE7;
    $������� = "pack";
    $G8veFvPE7 = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][1]);
    $G8vvPE7 = 56 * ���Ӽ��;
    $G8vvPE8 = $G8vvPE7 - 2800;
    $G8vvPE9 = $G8vvPE8 - 1100;
    $G8vvPEA = ���Ӽ�� * 22;
    $G8vvPEB = $G8vvPE9 + $G8vvPEA;
    $G8vvPEC = $G8vvPEB - 2500;
    $G8vvPED = ���Ӽ�� * 50;
    $G8vvPEE = $G8vvPEC + $G8vvPED;
    $����� = "pack";
    $G8veFvPE8 = $�����($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][0x2]);
    unset($G8vtIEF);
    $G8vtIEF = input($G8veFvPE7, $G8vvPEE, $G8veFvPE8);
    $�ւͻ̀ = $G8vtIEF;
    $G8vOiRy21 = 4113;
    if (request()->isAjax()) goto G8veWjgx15;
    goto G8vldMhx15;
    G8veWjgx15:
    $G8vOiRy21 = $G8vBuEt34[4] * $G8vBuEt34[0];
    goto G8vx14;
    G8vldMhx15:
    $G8vOiRy21 = $G8vBuEt34[1] * $G8vBuEt34[0];
    G8vx14:
    $G8vE7 = 9 * 8;
    $G8vE8 = $G8vE7 - 24;
    $G8vE9 = $G8vOiRy21 == $G8vE8;
    if ($G8vE9) goto G8veWjgx1g;
    goto G8vldMhx1g;
    G8veWjgx1g:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������ = $G8vtIE7;
    $G8veFvPE7 = $������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][1]);
    $G8vE7 = 56 * ���Ӽ��;
    $G8vE8 = $G8vE7 - 2800;
    $G8vE9 = $G8vE8 - 1100;
    $G8vEA = ���Ӽ�� * 22;
    $G8vEB = $G8vE9 + $G8vEA;
    $G8vEC = $G8vEB - 2500;
    $G8vED = ���Ӽ�� * 50;
    $G8vEE = $G8vEC + $G8vED;
    unset($G8vtIEF);
    $G8vtIEF = $G8vEE;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEF;
    $������ = []; // MODIFY FOR LOCAL
    $������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�ܺ��� = $G8vtIE7;
    $G8veFvPE7 = $�ܺ���($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][9]);
    $G8vE7 = 56 * ���Ӽ��;
    $G8vE8 = $G8vE7 - 2800;
    $G8vE9 = $G8vE8 - 1100;
    $G8vEA = ���Ӽ�� * 22;
    $G8vEB = $G8vE9 + $G8vEA;
    $G8vEC = $G8vEB - 2500;
    $G8vED = ���Ӽ�� * 50;
    $G8vEE = $G8vEC + $G8vED;
    unset($G8vtIEF);
    $G8vtIEF = $G8vEE;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEF;
    $������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $����䯴 = $G8vtIE7;
    $G8veFvPE7 = $����䯴($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][10]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFE8 = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][6]);
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE8;
    $������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $����э� = $G8vtIE7;
    $G8veFvPE7 = $����э�($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][013]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFE8 = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][6]);
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE8;
    $������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�ض���� = $G8vtIE7;
    $G8veFvPE7 = $�ض����($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][12]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFE8 = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][6]);
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE8;
    $������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $����ԋ� = $G8vtIE7;
    $G8veFvPE7 = $����ԋ�($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][015]);
    $G8vE7 = 56 * ���Ӽ��;
    $G8vE8 = $G8vE7 - 2800;
    $G8vE9 = $G8vE8 - 1100;
    $G8vEA = ���Ӽ�� * 22;
    $G8vEB = $G8vE9 + $G8vEA;
    $G8vEC = $G8vEB - 2500;
    $G8vED = ���Ӽ�� * 50;
    $G8vEE = $G8vEC + $G8vED;
    unset($G8vtIEF);
    $G8vtIEF = $G8vEE;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEF;
    $������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPE7 = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][14]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFE8 = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][6]);
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE8;
    $������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPE7 = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][15]);
    $G8vE7 = 56 * ���Ӽ��;
    $G8vE8 = $G8vE7 - 2800;
    $G8vE9 = $G8vE8 - 1100;
    $G8vEA = ���Ӽ�� * 22;
    $G8vEB = $G8vE9 + $G8vEA;
    $G8vEC = $G8vEB - 2500;
    $G8vED = ���Ӽ�� * 50;
    $G8vEE = $G8vEC + $G8vED;
    unset($G8vtIEF);
    $G8vtIEF = $G8vEE;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEF;
    $������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�ܺ�Ǭ� = $G8vtIE7;
    $G8veFvPE7 = $�ܺ�Ǭ�($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][020]);
    $G8vE7 = 56 * ���Ӽ��;
    $G8vE8 = $G8vE7 - 2800;
    $G8vE9 = $G8vE8 - 1100;
    $G8vEA = ���Ӽ�� * 22;
    $G8vEB = $G8vE9 + $G8vEA;
    $G8vEC = $G8vEB - 2500;
    $G8vED = ���Ӽ�� * 50;
    $G8vEE = $G8vEC + $G8vED;
    unset($G8vtIEF);
    $G8vtIEF = $G8vEE;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEF;
    $������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������ = $G8vtIE7;
    $G8veFvPE7 = $������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][0x11]);
    $G8vE7 = 56 * ���Ӽ��;
    $G8vE8 = $G8vE7 - 2800;
    $G8vE9 = $G8vE8 - 1100;
    $G8vEA = ���Ӽ�� * 22;
    $G8vEB = $G8vE9 + $G8vEA;
    $G8vEC = $G8vEB - 2500;
    $G8vED = ���Ӽ�� * 50;
    $G8vEE = $G8vEC + $G8vED;
    unset($G8vtIEF);
    $G8vtIEF = $G8vEE;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEF;
    $������ = []; // MODIFY FOR LOCAL
    $������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���ێ�� = $G8vtIE7;
    $G8veFvPE7 = $���ێ��($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][18]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���ĳ�� = $G8vtIE7;
    $G8veFE8 = $���ĳ��($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][6]);
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE8;
    $������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPE7 = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][023]);
    $G8vE7 = 56 * ���Ӽ��;
    $G8vE8 = $G8vE7 - 2800;
    $G8vE9 = $G8vE8 - 1100;
    $G8vEA = ���Ӽ�� * 22;
    $G8vEB = $G8vE9 + $G8vEA;
    $G8vEC = $G8vEB - 2500;
    $G8vED = ���Ӽ�� * 50;
    $G8vEE = $G8vEC + $G8vED;
    unset($G8vtIEF);
    $G8vtIEF = $G8vEE;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEF;
    $������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������ = $G8vtIE7;
    $G8veFvPE7 = $������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][024]);
    $G8vE7 = 56 * ���Ӽ��;
    $G8vE8 = $G8vE7 - 2800;
    $G8vE9 = $G8vE8 - 1100;
    $G8vEA = ���Ӽ�� * 22;
    $G8vEB = $G8vE9 + $G8vEA;
    $G8vEC = $G8vEB - 2500;
    $G8vED = ���Ӽ�� * 50;
    $G8vEE = $G8vEC + $G8vED;
    unset($G8vtIEF);
    $G8vtIEF = $G8vEE;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEF;
    $������ = []; // MODIFY FOR LOCAL
    $������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���̅� = $G8vtIE7;
    $G8veFvPE7 = $���̅�($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][0x15]);
    $G8vE7 = 56 * ���Ӽ��;
    $G8vE8 = $G8vE7 - 2800;
    $G8vE9 = $G8vE8 - 1100;
    $G8vEA = ���Ӽ�� * 22;
    $G8vEB = $G8vE9 + $G8vEA;
    $G8vEC = $G8vEB - 2500;
    $G8vED = ���Ӽ�� * 50;
    $G8vEE = $G8vEC + $G8vED;
    unset($G8vtIEF);
    $G8vtIEF = $G8vEE;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEF;
    $������[$G8veFvPE7] = $G8vtIE7;
    $G8vE7 = !empty($�ւͻ̀);
    if ($G8vE7) goto G8veWjgx1a;
    goto G8vldMhx1a;
    G8veWjgx1a:
    unset($G8vtIE7);
    $G8vtIE7 = $this->GoodsModel->getDataById($�ւͻ̀);
    $������ = $G8vtIE7;
    $G8vE7 = !$������;
    if ($G8vE7) goto G8veWjgx1c;
    goto G8vldMhx1c;
    G8veWjgx1c:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���ѥ�� = $G8vtIE7;
    $G8veFvPE7 = $���ѥ��($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][026]);
    return $this->error($G8veFvPE7);
    goto G8vx1b;
    G8vldMhx1c:
    G8vx1b:
    unset($G8vtIE7);
    $G8vtIE7 = $this->GoodsLogic->formatData($������);
    $������ = $G8vtIE7;
    goto G8vx19;
    G8vldMhx1a:
    G8vx19:
    $G8vvPE7 = ���Ӽ�� * 42;
    $G8vvPE8 = $G8vvPE7 - 2099;
    unset($G8vtIE9);
    $G8vtIE9 = $this->CategoryModel->tree($this->shopid, $G8vvPE8);
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE9;
    $��̽�� = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPvPE7 = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][4]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPvPE8 = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][0x17]);
    $G8vzAvPE9 = array();
    $G8vzAvPE9[] = $G8veFvPvPE7;
    $G8vzAvPE9[] = $G8veFvPvPE8;
    $G8vzAvPE9[] = $this->shopid;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPvPEA = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][0x11]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPvPEB = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][0x17]);
    $G8vvPvPE7 = ���Ӽ�� * 42;
    $G8vvPvPE8 = $G8vvPvPE7 - 2099;
    $G8vzAvPEC = array();
    $G8vzAvPEC[] = $G8veFvPvPEA;
    $G8vzAvPEC[] = $G8veFvPvPEB;
    $G8vzAvPEC[] = $G8vvPvPE8;
    $G8vzAED = array();
    $G8vzAED[] = $G8vzAvPE9;
    $G8vzAED[] = $G8vzAvPEC;
    unset($G8vtIE9);
    $G8vtIE9 = $G8vzAED;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE9;
    $������� = $G8vtIE7;
    $G8vvPE7 = ���Ӽ�� * 64;
    $G8vvPE8 = $G8vvPE7 - 2201;
    unset($G8vtIE9);
    $G8vtIE9 = $this->AttributeModel->getList($�������, $G8vvPE8)->toArray();
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE9;
    $Ց���� = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = $this->AttributeLogic->attributeTree($Ց����);
    $Ց���� = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $Ϯ�ľ�� = $G8vtIE7;
    $G8veFvPvPE7 = $Ϯ�ľ��($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][14]);
    $G8vvPE7 = 56 * ���Ӽ��;
    $G8vvPE8 = $G8vvPE7 - 2800;
    $G8vvPE9 = $G8vvPE8 - 1100;
    $G8vvPEA = ���Ӽ�� * 22;
    $G8vvPEB = $G8vvPE9 + $G8vvPEA;
    $G8vvPEC = $G8vvPEB - 2500;
    $G8vvPED = ���Ӽ�� * 50;
    $G8vvPEE = $G8vvPEC + $G8vvPED;
    $G8vvPEF = $������[$G8veFvPvPE7] ?? $G8vvPEE;
    unset($G8vtIEG);
    $G8vtIEG = $this->AttributeLogic->checkedVal($G8vvPEF, $Ց����);
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEG;
    $Ց���� = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $��Ʒ�� = $G8vtIE7;
    $G8veFvPvPE7 = $��Ʒ��($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][0x18]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPvPE8 = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][0x19]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPvPE9 = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][032]);
    $G8vzAvPEA = array();
    $G8vzAvPEA[$G8veFvPvPE7] = $������;
    $G8vzAvPEA[$G8veFvPvPE8] = $��̽��;
    $G8vzAvPEA[$G8veFvPvPE9] = $Ց����;
    View::assign($G8vzAvPEA);
    $G8vE7 = !empty($�ւͻ̀);
    if ($G8vE7) goto G8veWjgx1e;
    goto G8vldMhx1e;
    G8veWjgx1e:
    unset($G8vtIEA);
    $G8vtIEA = "pack";
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEA;
    $������� = $G8vtIE7;
    $G8veFE8 = $�������($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][033]);
    $G8vE8 = $G8veFE8;
    goto G8vx1d;
    G8vldMhx1e:
    unset($G8vtIEB);
    $G8vtIEB = "pack";
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEB;
    $�ųݶ� = $G8vtIE7;
    $G8veFE9 = $�ųݶ�($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][28]);
    $G8vE8 = $G8veFE9;
    G8vx1d:
    unset($G8vtIE9);
    $G8vtIE9 = $G8vE8;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE9;
    $����΁� = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $��÷��� = $G8vtIE7;
    $G8veFvPE7 = $��÷���($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][035]);
    $G8vvPE7 = $����΁� . $G8veFvPE7;
    $this->setTitle($G8vvPE7);

    $brands = Brand::where('status', 1)->select(); // MODIFY FOR DEVELOP
    View::assign('brands', $brands); // MODIFY FOR DEVELOP

    return View::fetch();
    goto G8vx1f;
    G8vldMhx1g:
    $G8vE7 = 16 * 17;
    $G8vE8 = $G8vE7 - 260;
    $G8vE9 = $G8vOiRy21 == $G8vE8;
    if ($G8vE9) goto G8veWjgx1h;
    goto G8vldMhx1h;
    G8veWjgx1h:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�闬��� = $G8vtIE7;
    $G8veFvPE7 = $�闬���($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][0x3]);
    unset($G8vtIE7);
    $G8vtIE7 = input($G8veFvPE7);
    $������ = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $ْ����� = $G8vtIE7;
    $G8veFvPE7 = $ْ�����($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][4]);
    unset($G8vtIE7);
    $G8vtIE7 = $this->shopid;
    $������[$G8veFvPE7] = $G8vtIE7;
    try {
      validate(ScoreshopGoods::class)->check($������);
    } catch (ValidateException $�ş�鸋) {
      return $this->error($�ş�鸋->getError());
    }
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�Ǉ���� = $G8vtIE7;
    $G8veFvPE7 = $�Ǉ����($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][4]);
    unset($G8vtIE7);
    $G8vtIE7 = $this->shopid;
    $������[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);

    // MODIFY FOR DEVELOP
    $isLatest = isset($������['is_latest']) && $������['is_latest'] === 'on';
    $isHottest = isset($������['is_hottest']) && $������['is_hottest'] === 'on';
    $isSpecialDiscount = isset($������['is_special_discount']) && $������['is_special_discount'] === 'on';
    $isWomenArea = isset($������['is_women_area']) && $������['is_women_area'] === 'on';
    $isMenArea = isset($������['is_men_area']) && $������['is_men_area'] === 'on';
    $brandId = $������['brand_id'];
    $titleInEnglish = $������['title'];
    $titleInHindi = $������['title_hi'];
    $titleInIndonesia = $������['title_id'];
    $titleInJapan = $������['title_ja'];
    $titleInThai = $������['title_th'];
    $titleInVietnamese = $������['title_vi'];
    $titleInMelayu = $������['title_ms'];
    $titleInArabic = $������['title_ar'];
    $titleInChinese = $������['title_zh'];
    $titleInPortuguese = $������['title_pt'];
    $titleInSpanish = $������['title_es'];

    $descriptionInEnglish = $������['description'];
    $descriptionInHindi = $������['description_hi'];
    $descriptionInIndonesia = $������['description_id'];
    $descriptionInJapan = $������['description_ja'];
    $descriptionInThai = $������['description_th'];
    $descriptionInVietnamese = $������['description_vi'];
    $descriptionInMelayu = $������['description_ms'];
    $descriptionInArabic = $������['description_ar'];
    $descriptionInChinese = $������['description_zh'];
    $descriptionInPortuguese = $������['description_pt'];
    $descriptionInSpanish = $������['description_es'];

    // $contentInEnglish = $������['content'];
    // $contentInHindi = $������['content_hi'];
    // $contentInIndonesia = $������['content_id'];
    // $contentInJapan = $������['content_ja'];
    // $contentInThai = $������['content_th'];
    // $contentInVietnamese = $������['content_vi'];
    // $contentInMelayu = $������['content_ms'];
    // $contentInArabic = $������['content_ar'];
    // $contentInChinese = $������['content_zh'];
    // MODIFY FOR DEVELOP

    $G8vtIE7 = $this->GoodsLogic->queryData($������);
    $������ = $G8vtIE7;
    unset($������['sku']);
    $G8vtIE7 = $this->GoodsModel->edit($������);

    // MODIFY FOR DEVELOP
    $record = Db::table('muucmf_scoreshop_goods')->find($G8vtIE7);
    if ($record) {
      Db::table('muucmf_scoreshop_goods')->where('id', $G8vtIE7)->update([
        'is_latest' => $isLatest,
        'is_hottest' => $isHottest,
        'is_special_discount' => $isSpecialDiscount,
        'is_women_area' => $isWomenArea,
        'is_men_area' => $isMenArea,
        'brand_id' => $brandId,
        'title' => $titleInEnglish,
        'title_hi' => $titleInHindi,
        'title_id' => $titleInIndonesia,
        'title_ja' => $titleInJapan,
        'title_th' => $titleInThai,
        'title_vi' => $titleInVietnamese,
        'title_ms' => $titleInMelayu,
        'title_zh' => $titleInChinese,
        'title_ar' => $titleInArabic,
        'title_pt' => $titleInPortuguese,
        'title_es' => $titleInSpanish,
        'description' => $descriptionInEnglish,
        'description_hi' => $descriptionInHindi,
        'description_id' => $descriptionInIndonesia,
        'description_ja' => $descriptionInJapan,
        'description_th' => $descriptionInThai,
        'description_vi' => $descriptionInVietnamese,
        'description_ms' => $descriptionInMelayu,
        'description_zh' => $descriptionInChinese,
        'description_ar' => $descriptionInArabic,
        'description_pt' => $descriptionInPortuguese,
        'description_es' => $descriptionInSpanish,
        // 'content_en' => $contentInEnglish,
        // 'content_hi' => $contentInHindi,
        // 'content_id' => $contentInIndonesia,
        // 'content_ja' => $contentInJapan,
        // 'content_th' => $contentInThai,
        // 'content_vi' => $contentInVietnamese,
        // 'content_ms' => $contentInMelayu,
        // 'content_zh' => $contentInChinese,
        // 'content_ar' => $contentInArabic,
      ]);
    }

    try {
      $tnt = new TNTSearch;
      $token = new JieBaTokenizer();
      $tnt->loadConfig(config('tntsearch'));

      $indexer = $tnt->createIndex('scoreshop_goods.index');
      $indexer->query('SELECT id, title, title_hi, title_id, title_ja, title_th, title_vi, title_ms, title_zh, title_ar FROM muucmf_scoreshop_goods;');
      $indexer->setTokenizer($token);
      $indexer->inMemory = false;
      ob_start();
      $indexer->run();
      ob_end_clean();
    } catch (\Exception $e) {
      echo "An error occurred: " . $e->getMessage();
    }
    // MODIFY FOR DEVELOP

    $����ù� = $G8vtIE7;
    if ($����ù�) goto G8veWjgx18;
    goto G8vldMhx18;
    G8veWjgx18:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $ث����� = $G8vtIE7;
    $G8veFvPE7 = $ث�����($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][05]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $��̊��� = $G8vtIE7;
    $G8veFvPE8 = $��̊���($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][6]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�����ȧ = $G8vtIE7;
    $G8veFvPvPE9 = $�����ȧ($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][07]);
    return $this->success($G8veFvPE7, $G8veFvPE8, '/scoreshop/admin.goods/lists.html'); // MODIFY FOR DEVELOP
    goto G8vx17;
    G8vldMhx18:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $ᇍ�Ռ� = $G8vtIE7;
    $G8veFvPE7 = $ᇍ�Ռ�($GLOBALS[ڽ�踤][0x0], $GLOBALS[ڽ�踤][010]);
    return $this->error($G8veFvPE7);
    G8vx17:
    goto G8vx1f;
    G8vldMhx1h:
    G8vx1f:
  }

  public function status(int $status = 0)
  {
    $G8vBuEt35 = array();
    $G8vBuEt35[] = 17;
    $G8vBuEt35[] = 19;
    $G8vBuEt35[] = 3;
    $G8vBuEt35[] = 8;
    $G8vBuEt35[] = 17;
    $G8vOiRy22 = 6868;
    $����Ⱦ� = "defined";
    $G8veFE7 = $����Ⱦ�("Π��");
    $G8vE7 = !$G8veFE7;
    if ($G8vE7) goto G8veWjgx1k;
    goto G8vldMhx1k;
    G8veWjgx1k:
    $�����հ = "define";
    $G8veFE7 = $�����հ("Π��", "�����ϙ");
    goto G8vx1j;
    G8vldMhx1k:
    G8vx1j:
    $�����ƛ = "explode";
    $G8veFE7 = $�����ƛ("|<|g|n", "H*|<|g|n6964732F61|<|g|nF091EEB4F7C490|<|g|nBACEA7D4BFDEC0|<|g|n2C|<|g|n737461747573|<|g|n696E7476616C|<|g|nE69BB4E696B0|<|g|nE7A681E794A8|<|g|nE590AFE794A8|<|g|nE588A0E999A4|<|g|n6964|<|g|n696E|<|g|nE68890E58A9F|<|g|nE5A4B1E8B4A5");
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE7;
    $GLOBALS[Π��] = $G8vtIE7;
    $���ક� = "pack";
    $G8veFvPE7 = $���ક�($GLOBALS[Π��][00], $GLOBALS[Π��][1]);
    unset($G8vtIE7);
    $G8vtIE7 = input($G8veFvPE7);
    $ˎ����� = $G8vtIE7;
    $��Ὄ�� = "pack";
    $G8veFvPE7 = $��Ὄ��($GLOBALS[Π��][00], $GLOBALS[Π��][02]);
    $G8vE7 = !$GLOBALS[$G8veFvPE7]($ˎ�����);
    $G8vE9 = (bool)$G8vE7;
    $G8vOiRy24 = 6873;
    if ($G8vE9) goto G8veWjgx1m;
    goto G8vldMhx1m;
    G8veWjgx1m:
    $G8vOiRy24 = $G8vBuEt35[2] * $G8vBuEt35[3];
    goto G8vx1l;
    G8vldMhx1m:
    G8vx1l:
    $G8vED = 19 * 14;
    $G8vEE = $G8vED - 242;
    $G8vEF = $G8vOiRy24 == $G8vEE;
    if ($G8vEF) goto G8veWjgx1o;
    goto G8vldMhx1o;
    G8veWjgx1o:
    unset($G8vtIEA);
    $G8vtIEA = "pack";
    unset($G8vtIEG);
    $G8vtIEG = $G8vtIEA;
    $����ٽ� = $G8vtIEG;
    $G8veFvPE8 = $����ٽ�($GLOBALS[Π��][00], $GLOBALS[Π��][0x3]);
    unset($G8vtIEB);
    $G8vtIEB = "pack";
    unset($G8vtIEH);
    $G8vtIEH = $G8vtIEB;
    $ᣃ���� = $G8vtIEH;
    $G8veFvPE9 = $ᣃ����($GLOBALS[Π��][00], $GLOBALS[Π��][0x4]);
    unset($G8vtIE8);
    $G8vtIE8 = $GLOBALS[$G8veFvPE8]($G8veFvPE9, $ˎ�����);
    unset($G8vtIEC);
    $G8vtIEC = $G8vtIE8;
    unset($G8vtIEI);
    $G8vtIEI = $G8vtIEC;
    $ˎ����� = $G8vtIEI;
    $G8vE9 = (bool)$G8vtIE8;
    goto G8vx1n;
    G8vldMhx1o:
    G8vx1n:
    $��򊋳� = "pack";
    $G8veFvPE7 = $��򊋳�($GLOBALS[Π��][00], $GLOBALS[Π��][0x5]);
    $G8vvPE7 = 18 * ���Ӽ��;
    $G8vvPE8 = $G8vvPE7 - 900;
    $��ա�� = "pack";
    $G8veFvPE8 = $��ա��($GLOBALS[Π��][00], $GLOBALS[Π��][0x6]);
    unset($G8vtIE9);
    $G8vtIE9 = input($G8veFvPE7, $G8vvPE8, $G8veFvPE8);
    $status = $G8vtIE9;
    $���ܩ�� = "pack";
    $G8veFE7 = $���ܩ��($GLOBALS[Π��][00], $GLOBALS[Π��][07]);
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE7;
    $������� = $G8vtIE7;
    $G8vOiRy26 = 6872;
    $G8vE7 = 18 * ���Ӽ��;
    $G8vE8 = $G8vE7 - 900;
    $G8vE9 = $status == $G8vE8;
    if ($G8vE9) goto G8veWjgx1q;
    goto G8vldMhx1q;
    G8veWjgx1q:
    $G8vOiRy26 = $G8vBuEt35[4] * $G8vBuEt35[1];
    goto G8vx1p;
    G8vldMhx1q:
    G8vx1p:
    $G8vE7 = 2 * 19;
    $G8vE8 = $G8vE7 + 285;
    $G8vE9 = $G8vOiRy26 == $G8vE8;
    if ($G8vE9) goto G8veWjgx1s;
    goto G8vldMhx1s;
    G8veWjgx1s:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $Р���� = $G8vtIE7;
    $G8veFE7 = $Р����($GLOBALS[Π��][00], $GLOBALS[Π��][0x8]);
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE7;
    $������� = $G8vtIE7;
    goto G8vx1r;
    G8vldMhx1s:
    G8vx1r:
    $G8vOiRy28 = 6859;
    $G8vE7 = 0 - 1199;
    $G8vE8 = 24 * ���Ӽ��;
    $G8vE9 = $G8vE7 + $G8vE8;
    $G8vEA = $status == $G8vE9;
    if ($G8vEA) goto G8veWjgx1u;
    goto G8vldMhx1u;
    G8veWjgx1u:
    $G8vOiRy28 = $G8vBuEt35[3] * $G8vBuEt35[2];
    goto G8vx1t;
    G8vldMhx1u:
    G8vx1t:
    $G8vE7 = 4 * 10;
    $G8vE8 = $G8vE7 - 16;
    $G8vE9 = $G8vOiRy28 == $G8vE8;
    if ($G8vE9) goto G8veWjgx1w;
    goto G8vldMhx1w;
    G8veWjgx1w:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�Ɔ���� = $G8vtIE7;
    $G8veFE7 = $�Ɔ����($GLOBALS[Π��][00], $GLOBALS[Π��][0x9]);
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE7;
    $������� = $G8vtIE7;
    goto G8vx1v;
    G8vldMhx1w:
    G8vx1v:
    $G8vOiRy30 = 6863;
    $G8vE7 = 0 - 1199;
    $G8vE8 = 24 * ���Ӽ��;
    $G8vE9 = $G8vE7 + $G8vE8;
    $G8vEA = -1 * $G8vE9;
    $G8vEB = $status == $G8vEA;
    if ($G8vEB) goto G8veWjgx1y;
    goto G8vldMhx1y;
    G8veWjgx1y:
    $G8vOiRy30 = $G8vBuEt35[4] * $G8vBuEt35[4];
    goto G8vx1x;
    G8vldMhx1y:
    G8vx1x:
    $G8vE7 = 12 * 5;
    $G8vE8 = $G8vE7 + 229;
    $G8vE9 = $G8vOiRy30 == $G8vE8;
    if ($G8vE9) goto G8veWjgx21;
    goto G8vldMhx21;
    G8veWjgx21:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���ݞԾ = $G8vtIE7;
    $G8veFE7 = $���ݞԾ($GLOBALS[Π��][00], $GLOBALS[Π��][012]);
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE7;
    $������� = $G8vtIE7;
    goto G8vx2z;
    G8vldMhx21:
    G8vx2z:
    $̫���� = "pack";
    $G8veFvPE7 = $̫����($GLOBALS[Π��][00], $GLOBALS[Π��][0x5]);
    unset($G8vtIE7);
    $G8vtIE7 = $status;
    $�γ�͂�[$G8veFvPE7] = $G8vtIE7;
    $к����� = "pack";
    $G8veFvPE7 = $к�����($GLOBALS[Π��][00], $GLOBALS[Π��][013]);
    $������� = "pack";
    $G8veFvPE8 = $�������($GLOBALS[Π��][00], $GLOBALS[Π��][014]);
    unset($G8vtIE7);
    $G8vtIE7 = $this->GoodsModel->where($G8veFvPE7, $G8veFvPE8, $ˎ�����)->update($�γ�͂�);
    $������ = $G8vtIE7;
    $G8vOiRy32 = 6871;
    if ($������) goto G8veWjgx23;
    goto G8vldMhx23;
    G8veWjgx23:
    $G8vOiRy32 = $G8vBuEt35[0] * $G8vBuEt35[4];
    goto G8vx22;
    G8vldMhx23:
    $G8vOiRy32 = $G8vBuEt35[1] * $G8vBuEt35[1];
    G8vx22:
    $G8vE7 = 11 * 6;
    $G8vE8 = $G8vE7 + 295;
    $G8vE9 = $G8vOiRy32 == $G8vE8;
    if ($G8vE9) goto G8veWjgx25;
    goto G8vldMhx25;
    G8veWjgx25:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�ص��̫ = $G8vtIE7;
    $G8veFvPE7 = $�ص��̫($GLOBALS[Π��][00], $GLOBALS[Π��][016]);
    $G8vvPE7 = $������� . $G8veFvPE7;
    return $this->error($G8vvPE7);
    goto G8vx24;
    G8vldMhx25:
    $G8vE7 = 19 * 8;
    $G8vE8 = $G8vE7 + 137;
    $G8vE9 = $G8vOiRy32 == $G8vE8;
    if ($G8vE9) goto G8veWjgx26;
    goto G8vldMhx26;
    G8veWjgx26:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $헐��� = $G8vtIE7;
    $G8veFvPE7 = $헐���($GLOBALS[Π��][00], $GLOBALS[Π��][015]);
    $G8vvPE7 = $������� . $G8veFvPE7;
    return $this->success($G8vvPE7);
    goto G8vx24;
    G8vldMhx26:
    G8vx24:
  }

  public function sku()
  {
    $G8vBuEt36 = array();
    $G8vBuEt36[] = 10;
    $G8vBuEt36[] = 2;
    $G8vBuEt36[] = 2;
    $G8vBuEt36[] = 17;
    $G8vBuEt36[] = 18;
    $G8vOiRy33 = 5837;
    $���ɇ� = "defined";
    $G8veFE7 = $���ɇ�("ٳ�����");
    $G8vE7 = !$G8veFE7;
    if ($G8vE7) goto G8veWjgx28;
    goto G8vldMhx28;
    G8veWjgx28:
    $����̬� = "define";
    $G8veFE7 = $����̬�("ٳ�����", "��簑�");
    goto G8vx27;
    G8vldMhx28:
    G8vx27:
    $����ߋ = "explode";
    $G8veFE7 = $����ߋ("|0|}|U", "H*|0|}|U6964|0|}|U696E7476616C|0|}|U706172616D2E736B75|0|}|U|0|}|U736B75|0|}|UE4BF9DE5AD98E68890E58A9FEFBC81|0|}|U5F5F666F72776172645F5F|0|}|UE4BF9DE5AD98E5A4B1E8B4A5|0|}|UE6B2A1E69C89E69FA5E8AFA2E588B0E79BB8E585B3E695B0E68DAE|0|}|U6C69737473|0|}|U64617461|0|}|U7469746C65|0|}|U2D534B55E8A784E6A0BC");
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE7;
    $GLOBALS[ٳ�����] = $G8vtIE7;
    $�Ȕ���� = "pack";
    $G8veFvPE7 = $�Ȕ����($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][1]);
    $G8vvPE7 = ���Ӽ�� * 77;
    $G8vvPE8 = $G8vvPE7 - 3850;
    $װ���ȸ = "pack";
    $G8veFvPE8 = $װ���ȸ($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][2]);
    unset($G8vtIE9);
    $G8vtIE9 = input($G8veFvPE7, $G8vvPE8, $G8veFvPE8);
    $�ڄ�吽 = $G8vtIE9;
    $G8vOiRy37 = 5838;
    if (request()->isAjax()) goto G8veWjgx2a;
    goto G8vldMhx2a;
    G8veWjgx2a:
    $G8vOiRy37 = $G8vBuEt36[3] * $G8vBuEt36[0];
    goto G8vx29;
    G8vldMhx2a:
    G8vx29:
    $G8vE7 = 1 * 13;
    $G8vE8 = $G8vE7 + 157;
    $G8vE9 = $G8vOiRy37 == $G8vE8;
    if ($G8vE9) goto G8veWjgx2g;
    goto G8vldMhx2g;
    G8veWjgx2g:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���ƚӡ = $G8vtIE7;
    $G8veFvPE7 = $���ƚӡ($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][3]);
    unset($G8vtIE7);
    $G8vtIE7 = input($G8veFvPE7);
    $���֋�� = $G8vtIE7;
    if (empty($���֋��)) goto G8veWjgx2c;
    goto G8vldMhx2c;
    G8veWjgx2c:
    unset($G8vtIE9);
    $G8vtIE9 = "pack";
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE9;
    $�˔���� = $G8vtIE7;
    $G8veFE8 = $�˔����($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][4]);
    $G8vE7 = $G8veFE8;
    goto G8vx2b;
    G8vldMhx2c:
    $G8vE7 = json_encode($���֋��);
    G8vx2b:
    unset($G8vtIE8);
    $G8vtIE8 = $G8vE7;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE8;
    $���֋�� = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPvPE7 = $�������($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][1]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���⬠� = $G8vtIE7;
    $G8veFvPvPE8 = $���⬠�($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][0x5]);
    $G8vzAvPE9 = array();
    $G8vzAvPE9[$G8veFvPvPE7] = $�ڄ�吽;
    $G8vzAvPE9[$G8veFvPvPE8] = $���֋��;
    unset($G8vtIE7);
    $G8vtIE7 = $this->GoodsModel->edit($G8vzAvPE9);
    $������ = $G8vtIE7;
    if ($������) goto G8veWjgx2e;
    goto G8vldMhx2e;
    G8veWjgx2e:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�ǌ���� = $G8vtIE7;
    $G8veFvPE7 = $�ǌ����($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][6]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������ = $G8vtIE7;
    $G8veFvPvPE8 = $������($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][0x7]);
    return $this->success($G8veFvPE7, $������, '/scoreshop/admin.goods/lists.html'); // MODIFY FOR DEVELOP
    goto G8vx2d;
    G8vldMhx2e:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $ƣ�ᵘ = $G8vtIE7;
    $G8veFvPE7 = $ƣ�ᵘ($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][010]);
    return $this->error($G8veFvPE7);
    G8vx2d:
    goto G8vx2f;
    G8vldMhx2g:
    G8vx2f:
    unset($G8vtIE7);
    $G8vtIE7 = $this->GoodsModel->getDataById($�ڄ�吽);
    $����١� = $G8vtIE7;
    $G8vOiRy39 = 5834;
    $G8vE7 = !$����١�;
    if ($G8vE7) goto G8veWjgx2i;
    goto G8vldMhx2i;
    G8veWjgx2i:
    $G8vOiRy39 = $G8vBuEt36[2] * $G8vBuEt36[3];
    goto G8vx2h;
    G8vldMhx2i:
    $G8vOiRy39 = $G8vBuEt36[4] * $G8vBuEt36[2];
    G8vx2h:
    $G8vE7 = 14 * 3;
    $G8vE8 = $G8vE7 - 8;
    $G8vE9 = $G8vOiRy39 == $G8vE8;
    if ($G8vE9) goto G8veWjgx2k;
    goto G8vldMhx2k;
    G8veWjgx2k:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�գ���� = $G8vtIE7;
    $G8veFvPE7 = $�գ����($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][0x9]);
    $this->error($G8veFvPE7);
    goto G8vx2j;
    G8vldMhx2k:
    $G8vE7 = 15 * 1;
    $G8vE8 = $G8vE7 + 21;
    $G8vE9 = $G8vOiRy39 == $G8vE8;
    if ($G8vE9) goto G8veWjgx2l;
    goto G8vldMhx2l;
    G8veWjgx2l:
    unset($G8vtIE7);
    $G8vtIE7 = $this->GoodsLogic->formatData($����١�);
    $����١� = $G8vtIE7;
    goto G8vx2j;
    G8vldMhx2l:
    G8vx2j:
    $G8vOiRy41 = 5834;
    if (empty($����١�)) goto G8veWjgx2n;
    goto G8vldMhx2n;
    G8veWjgx2n:
    $G8vOiRy41 = $G8vBuEt36[1] * $G8vBuEt36[2];
    goto G8vx2m;
    G8vldMhx2n:
    G8vx2m:
    $G8vE7 = 16 * 9;
    $G8vE8 = $G8vE7 - 140;
    $G8vE9 = $G8vOiRy41 == $G8vE8;
    if ($G8vE9) goto G8veWjgx2p;
    goto G8vldMhx2p;
    G8veWjgx2p:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $ꑰ���� = $G8vtIE7;
    $G8veFvPE7 = $ꑰ����($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][0x9]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $��ګ��� = $G8vtIE7;
    $G8veFvPvPE8 = $��ګ���($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][012]);
    return $this->error($G8veFvPE7, null, url($G8veFvPvPE8)->build());
    goto G8vx2o;
    G8vldMhx2p:
    G8vx2o:
    $�ݖ���� = "pack";
    $G8veFvPE7 = $�ݖ����($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][013]);
    View::assign($G8veFvPE7, $����١�);
    $������� = "pack";
    $G8veFvPvPE7 = $�������($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][0xC]);
    $������� = "pack";
    $G8veFvPE8 = $�������($GLOBALS[ٳ�����][0], $GLOBALS[ٳ�����][13]);
    $G8vvPE7 = $����١�[$G8veFvPvPE7] . $G8veFvPE8;
    $this->setTitle($G8vvPE7);
    return View::fetch();
  }

  public function editSku()
  {
    $aId = input('id', 0, 'intval');

    if (request()->isPost()) {
      $inputData = input() ?? [];

      $enFields = preg_grep('/_en$/', array_keys($inputData));
      $isEnFieldEmpty = false;

      foreach ($enFields as $key) {
        if (empty($inputData[$key])) {
          $isEnFieldEmpty = true;
          break;
        }
      }

      if ($isEnFieldEmpty) {
        return $this->error('English field cannot be empty');
      }

      $data = json_encode($inputData);

      $record = Db::table('muucmf_scoreshop_goods')->find($inputData['id']);
      if ($record) {
        Db::table('muucmf_scoreshop_goods')->where('id', $inputData['id'])->update([
          'sku_translations' => $data,
        ]);

        return $this->success(($aId == 0 ? lang('Add') : lang('Edit')) . lang('Success'), '', '/scoreshop/admin.Goods/editSku.html?id=' . $aId);
      } else {
        return $this->error(($aId == 0 ? lang('Add') : lang('Edit')) . lang('Failed'));
      }
    } else {

      if ($aId != 0) {
        $type = $this->GoodsModel->getScoreshopGood(['id' => $aId]);
      } else {
        $type = ['status' => 1, 'sort' => 0];
      }

      $languages = [
        'English' => 'en',
        'Arabic' => 'ar',
        'Hindi' => 'hi',
        'Indonesia' => 'id',
        'Japanese' => 'ja',
        'Thai' => 'th',
        'Vietnamese' => 'vi',
        'Melayu' => 'ms',
        'Chinese' => 'zh',
        'Portuguese' => 'pt',
        'Spanish' => 'es',
      ];

      $skuInfo = json_decode($type->sku);

      $builder = new AdminConfigBuilder();

      $builder
        ->title(($aId == 0 ? 'Add' : 'Edit') . ' SKU Translation')
        ->keyId();

      $skuTranslations = json_decode($type->sku_translations);
      $data = [];
      if (isset($skuTranslations)) {
        foreach ($skuTranslations as $key => $values) {
          $data[$key] = $values;
        }

        $builder->data($data);
      } else {
        $builder->data($type);
      }

      foreach ($skuInfo->table as $key => $values) {
        foreach ($languages as $language => $iso) {
          $builder->keyText(strtolower(str_replace([' ', '-'], '_', trim($key))) . '_' . $iso, $key . ' (' . $language . ')');
        }

        foreach ($values as $value) {
          foreach ($languages as $language => $languageIso) {
            $builder->keyText(strtolower(str_replace([' ', '-'], '_', trim($value))) . '_' . $languageIso, $value . ' (' . $language . ')');
          }
        }
      }

      $builder
        ->buttonSubmit(url('editSku'))
        ->buttonBack()
        ->display();
    }
  }
}
