<?php

namespace app\scoreshop\logic;

if (!defined("����ۂ")) define("����ۂ", "���倶�");
$GLOBALS[����ۂ] = explode("|I|l|W", "H*|I|l|WB0AADCFBAAD1C7");
if (!defined(pack($GLOBALS[����ۂ][00], $GLOBALS[����ۂ][1]))) define(pack($GLOBALS[����ۂ][00], $GLOBALS[����ۂ][1]), ord(40));
$G8vBuEt80 = array();
$G8vBuEt80[] = 5;
$G8vBuEt80[] = 14;
$G8vBuEt80[] = 20;
$G8vBuEt80[] = 13;
$G8vBuEt80[] = 16;
class Base
{
  public $_status = ["\x31" => "\xE5\xB7\xB2\xE4\xB8\x8A\xE6\x9E\xB6", "\x30" => "\xE5\xB7\xB2\xE4\xB8\x8B\xE6\x9E\xB6", "\x2D\x31" => "\xE5\xB7\xB2\xE5\x88\xA0\xE9\x99\xA4", "\x2D\x32" => "\xE5\xAE\xA1\xE6\xA0\xB8\xE6\x9C\xAA\xE9\x80\x9A\xE8\xBF\x87"];
  public function setCoverAttr($data, $proportion = '4:3')
  {
    $G8vBuEt81 = array();
    $G8vBuEt81[] = 9;
    $G8vBuEt81[] = 18;
    $G8vBuEt81[] = 6;
    $G8vBuEt81[] = 17;
    $G8vBuEt81[] = 14;
    $G8vOiRy0 = 5844;
    $�ñ���� = "defined";
    $G8veFE7 = $�ñ����("�ꔯ�Ǯ");
    $G8vE7 = !$G8veFE7;
    if ($G8vE7) goto G8veWjgx2;
    goto G8vldMhx2;
    G8veWjgx2:
    $����� = "define";
    $G8veFE7 = $�����("�ꔯ�Ǯ", "�����");
    goto G8vx1;
    G8vldMhx2:
    G8vx1:
    $醢��� = "explode";
    $G8veFE7 = $醢���("|Z|S|L", "H*|Z|S|L313A31|Z|S|L343A33|Z|S|L31363A39|Z|S|L333A35|Z|S|L636F766572|Z|S|L636F7665725F313030|Z|S|L636F7665725F323030|Z|S|L636F7665725F333030|Z|S|L636F7665725F343030|Z|S|L636F7665725F383030|Z|S|L2F7374617469632F636F6D6D6F6E2F696D616765732F6E6F7069632E706E67");
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE7;
    $GLOBALS[�ꔯ�Ǯ] = $G8vtIE7;
    $G8vOiRy2 = 5843;
    $������ = "pack";
    $G8veFE7 = $������($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][01]);
    $G8vE7 = $proportion == $G8veFE7;
    if ($G8vE7) goto G8veWjgx4;
    goto G8vldMhx4;
    G8veWjgx4:
    $G8vOiRy2 = $G8vBuEt81[4] * $G8vBuEt81[4];
    goto G8vx3;
    G8vldMhx4:
    G8vx3:
    $G8vE7 = 18 * 4;
    $G8vE8 = $G8vE7 + 124;
    $G8vE9 = $G8vOiRy2 == $G8vE8;
    if ($G8vE9) goto G8veWjgx6;
    goto G8vldMhx6;
    G8veWjgx6:
    $G8vE7 = 0 - 316;
    $G8vE8 = 13 * E_CORE_WARNING;
    $G8vE9 = $G8vE7 + $G8vE8;
    unset($G8vtIEA);
    $G8vtIEA = $G8vE9;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEA;
    $Ռ���� = $G8vtIE7;
    $G8vE7 = 0 - 316;
    $G8vE8 = 13 * E_CORE_WARNING;
    $G8vE9 = $G8vE7 + $G8vE8;
    unset($G8vtIEA);
    $G8vtIEA = $G8vE9;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEA;
    $�ų��н = $G8vtIE7;
    goto G8vx5;
    G8vldMhx6:
    G8vx5:
    $G8vOiRy4 = 5844;
    $������� = "pack";
    $G8veFE7 = $�������($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][02]);
    $G8vE7 = $proportion == $G8veFE7;
    if ($G8vE7) goto G8veWjgx8;
    goto G8vldMhx8;
    G8veWjgx8:
    $G8vOiRy4 = $G8vBuEt81[2] * $G8vBuEt81[4];
    goto G8vx7;
    G8vldMhx8:
    G8vx7:
    $G8vE7 = 10 * 2;
    $G8vE8 = $G8vE7 + 64;
    $G8vE9 = $G8vOiRy4 == $G8vE8;
    if ($G8vE9) goto G8veWjgxa;
    goto G8vldMhxa;
    G8veWjgxa:
    $G8vE7 = 0 - 316;
    $G8vE8 = 13 * E_CORE_WARNING;
    $G8vE9 = $G8vE7 + $G8vE8;
    unset($G8vtIEA);
    $G8vtIEA = $G8vE9;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEA;
    $Ռ���� = $G8vtIE7;
    $G8vE7 = 0 - 3061;
    $G8vE8 = 98 * E_CORE_WARNING;
    $G8vE9 = $G8vE7 + $G8vE8;
    unset($G8vtIEA);
    $G8vtIEA = $G8vE9;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEA;
    $�ų��н = $G8vtIE7;
    goto G8vx9;
    G8vldMhxa:
    G8vx9:
    $G8vOiRy6 = 5849;
    $��Ҵ�� = "pack";
    $G8veFE7 = $��Ҵ��($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][0x3]);
    $G8vE7 = $proportion == $G8veFE7;
    if ($G8vE7) goto G8veWjgxc;
    goto G8vldMhxc;
    G8veWjgxc:
    $G8vOiRy6 = $G8vBuEt81[4] * $G8vBuEt81[0];
    goto G8vxb;
    G8vldMhxc:
    G8vxb:
    $G8vE7 = 8 * 9;
    $G8vE8 = $G8vE7 + 54;
    $G8vE9 = $G8vOiRy6 == $G8vE8;
    if ($G8vE9) goto G8veWjgxe;
    goto G8vldMhxe;
    G8veWjgxe:
    $G8vE7 = 0 - 316;
    $G8vE8 = 13 * E_CORE_WARNING;
    $G8vE9 = $G8vE7 + $G8vE8;
    unset($G8vtIEA);
    $G8vtIEA = $G8vE9;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEA;
    $Ռ���� = $G8vtIE7;
    $G8vE7 = 69 * E_CORE_WARNING;
    $G8vE8 = $G8vE7 - 2152;
    unset($G8vtIE9);
    $G8vtIE9 = $G8vE8;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE9;
    $�ų��н = $G8vtIE7;
    goto G8vxd;
    G8vldMhxe:
    G8vxd:
    $G8vOiRy8 = 5845;
    $������� = "pack";
    $G8veFE7 = $�������($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][04]);
    $G8vE7 = $proportion == $G8veFE7;
    if ($G8vE7) goto G8veWjgxg;
    goto G8vldMhxg;
    G8veWjgxg:
    $G8vOiRy8 = $G8vBuEt81[2] * $G8vBuEt81[3];
    goto G8vxf;
    G8vldMhxg:
    G8vxf:
    $G8vE7 = 18 * 13;
    $G8vE8 = $G8vE7 - 132;
    $G8vE9 = $G8vOiRy8 == $G8vE8;
    if ($G8vE9) goto G8veWjgxi;
    goto G8vldMhxi;
    G8veWjgxi:
    $G8vE7 = 0 - 316;
    $G8vE8 = 13 * E_CORE_WARNING;
    $G8vE9 = $G8vE7 + $G8vE8;
    unset($G8vtIEA);
    $G8vtIEA = $G8vE9;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEA;
    $Ռ���� = $G8vtIE7;
    $G8vE7 = 48 * E_CORE_WARNING;
    $G8vE8 = $G8vE7 - 1369;
    unset($G8vtIE9);
    $G8vtIE9 = $G8vE8;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE9;
    $�ų��н = $G8vtIE7;
    goto G8vxh;
    G8vldMhxi:
    G8vxh:
    $G8vOiRy10 = 5838;
    $�ۚ���� = "pack";
    $G8veFvPvPE7 = $�ۚ����($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][0x5]);
    if (empty($data[$G8veFvPvPE7])) goto G8veWjgxk;
    goto G8vldMhxk;
    G8veWjgxk:
    $G8vOiRy10 = $G8vBuEt81[2] * $G8vBuEt81[0];
    goto G8vxj;
    G8vldMhxk:
    $G8vOiRy10 = $G8vBuEt81[1] * $G8vBuEt81[0];
    G8vxj:
    $G8vE7 = 2 * 18;
    $G8vE8 = $G8vE7 + 126;
    $G8vE9 = $G8vOiRy10 == $G8vE8;
    if ($G8vE9) goto G8veWjgxm;
    goto G8vldMhxm;
    G8veWjgxm:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $��̝��� = $G8vtIE7;
    $G8veFvPE7 = $��̝���($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][6]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $��ƾǶ� = $G8vtIE7;
    $G8veFvPvPE8 = $��ƾǶ�($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][0x5]);
    unset($G8vtIE7);
    $G8vtIE7 = get_thumb_image($data[$G8veFvPvPE8], intval($Ռ����), intval($�ų��н));
    $data[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�ܪ�� = $G8vtIE7;
    $G8veFvPE7 = $�ܪ��($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][7]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $����� = $G8vtIE7;
    $G8veFvPvPE8 = $�����($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][0x5]);
    $G8vvPvPE7 = E_CORE_WARNING * 37;
    $G8vvPvPE8 = $G8vvPvPE7 - 1182;
    $G8vvPvPE9 = $Ռ���� * $G8vvPvPE8;
    $G8vvPvPEA = E_CORE_WARNING * 37;
    $G8vvPvPEB = $G8vvPvPEA - 1182;
    $G8vvPvPEC = $�ų��н * $G8vvPvPEB;
    unset($G8vtIED);
    $G8vtIED = get_thumb_image($data[$G8veFvPvPE8], intval($G8vvPvPE9), intval($G8vvPvPEC));
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIED;
    $data[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $��ҕΚ� = $G8vtIE7;
    $G8veFvPE7 = $��ҕΚ�($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][8]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���ѫ�� = $G8vtIE7;
    $G8veFvPvPE8 = $���ѫ��($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][0x5]);
    $G8vvPvPE7 = 81 * E_CORE_WARNING;
    $G8vvPvPE8 = $G8vvPvPE7 - 2589;
    $G8vvPvPE9 = $Ռ���� * $G8vvPvPE8;
    $G8vvPvPEA = 81 * E_CORE_WARNING;
    $G8vvPvPEB = $G8vvPvPEA - 2589;
    $G8vvPvPEC = $�ų��н * $G8vvPvPEB;
    unset($G8vtIED);
    $G8vtIED = get_thumb_image($data[$G8veFvPvPE8], intval($G8vvPvPE9), intval($G8vvPvPEC));
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIED;
    $data[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������ = $G8vtIE7;
    $G8veFvPE7 = $������($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][0x9]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $ܧȷ��� = $G8vtIE7;
    $G8veFvPvPE8 = $ܧȷ���($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][0x5]);
    $G8vvPvPE7 = 0 - 764;
    $G8vvPvPE8 = 24 * E_CORE_WARNING;
    $G8vvPvPE9 = $G8vvPvPE7 + $G8vvPvPE8;
    $G8vvPvPEA = $Ռ���� * $G8vvPvPE9;
    $G8vvPvPEB = 0 - 764;
    $G8vvPvPEC = 24 * E_CORE_WARNING;
    $G8vvPvPED = $G8vvPvPEB + $G8vvPvPEC;
    $G8vvPvPEE = $�ų��н * $G8vvPvPED;
    unset($G8vtIEF);
    $G8vtIEF = get_thumb_image($data[$G8veFvPvPE8], intval($G8vvPvPEA), intval($G8vvPvPEE));
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIEF;
    $data[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $ێ𔛲� = $G8vtIE7;
    $G8veFvPE7 = $ێ𔛲�($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][0xA]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������ = $G8vtIE7;
    $G8veFvPvPE8 = $������($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][0x5]);
    $G8vvPvPE7 = E_CORE_WARNING * 99;
    $G8vvPvPE8 = $G8vvPvPE7 - 3160;
    $G8vvPvPE9 = $Ռ���� * $G8vvPvPE8;
    $G8vvPvPEA = E_CORE_WARNING * 99;
    $G8vvPvPEB = $G8vvPvPEA - 3160;
    $G8vvPvPEC = $�ų��н * $G8vvPvPEB;
    unset($G8vtIED);
    $G8vtIED = get_thumb_image($data[$G8veFvPvPE8], intval($G8vvPvPE9), intval($G8vvPvPEC));
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIED;
    $data[$G8veFvPE7] = $G8vtIE7;
    goto G8vxl;
    G8vldMhxm:
    $G8vE7 = 4 * 5;
    $G8vE8 = $G8vE7 + 34;
    $G8vE9 = $G8vOiRy10 == $G8vE8;
    if ($G8vE9) goto G8veWjgxn;
    goto G8vldMhxn;
    G8veWjgxn:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $ڄ͚Η� = $G8vtIE7;
    $G8veFvPE7 = $ڄ͚Η�($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][0x5]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPE8 = $�������($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][6]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $ͱ��ƹ� = $G8vtIE7;
    $G8veFvPE9 = $ͱ��ƹ�($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][7]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���⛯� = $G8vtIE7;
    $G8veFvPEA = $���⛯�($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][8]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���ɍӧ = $G8vtIE7;
    $G8veFvPEB = $���ɍӧ($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][0x9]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPEC = $�������($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][0xA]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFED = $�������($GLOBALS[�ꔯ�Ǯ][0], $GLOBALS[�ꔯ�Ǯ][11]);
    $G8vE7 = request()->domain() . $G8veFED;
    unset($G8vtIE8);
    $G8vtIE8 = $G8vE7;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE8;
    $data[$G8veFvPEC] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE8;
    $data[$G8veFvPEB] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE8;
    $data[$G8veFvPEA] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE8;
    $data[$G8veFvPE9] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE8;
    $data[$G8veFvPE8] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = $G8vtIE8;
    $data[$G8veFvPE7] = $G8vtIE7;
    goto G8vxl;
    G8vldMhxn:
    G8vxl:
    return $data;
  }
  public function setTitleAttr($data)
  {
    $G8vBuEt82 = array();
    $G8vBuEt82[] = 11;
    $G8vBuEt82[] = 5;
    $G8vBuEt82[] = 9;
    $G8vBuEt82[] = 3;
    $G8vBuEt82[] = 9;
    $G8vOiRy11 = 1337;
    $�瓠�� = "defined";
    $G8veFE7 = $�瓠��("������");
    $G8vE7 = !$G8veFE7;
    if ($G8vE7) goto G8veWjgxp;
    goto G8vldMhxp;
    G8veWjgxp:
    $����틤 = "define";
    $G8veFE7 = $����틤("������", "����");
    goto G8vxo;
    G8vldMhxp:
    G8vxo:
    $��ұ��� = "explode";
    $G8veFE7 = $��ұ���("|Y|K|X", "H*|Y|K|X7469746C65|Y|K|XE6A087E9A298E4B8BAE7A9BA");
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE7;
    $GLOBALS[������] = $G8vtIE7;
    $G8vOiRy13 = 1350;
    $�֒���� = "pack";
    $G8veFvPvPE7 = $�֒����($GLOBALS[������][00], $GLOBALS[������][0x1]);
    if (empty($data[$G8veFvPvPE7])) goto G8veWjgxr;
    goto G8vldMhxr;
    G8veWjgxr:
    $G8vOiRy13 = $G8vBuEt82[0] * $G8vBuEt82[1];
    goto G8vxq;
    G8vldMhxr:
    G8vxq:
    $G8vE7 = 5 * 16;
    $G8vE8 = $G8vE7 - 25;
    $G8vE9 = $G8vOiRy13 == $G8vE8;
    if ($G8vE9) goto G8veWjgxt;
    goto G8vldMhxt;
    G8veWjgxt:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $����·� = $G8vtIE7;
    $G8veFvPE7 = $����·�($GLOBALS[������][00], $GLOBALS[������][0x1]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���� = $G8vtIE7;
    $G8veFE8 = $����($GLOBALS[������][00], $GLOBALS[������][2]);
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE8;
    $data[$G8veFvPE7] = $G8vtIE7;
    goto G8vxs;
    G8vldMhxt:
    G8vxs:
    return $data;
  }
  public function setStatusAttr($data, $attrArray = [])
  {
    $G8vBuEt83 = array();
    $G8vBuEt83[] = 17;
    $G8vBuEt83[] = 13;
    $G8vBuEt83[] = 15;
    $G8vBuEt83[] = 7;
    $G8vBuEt83[] = 7;
    $G8vOiRy14 = 4916;
    $���ѢԈ = "defined";
    $G8veFE7 = $���ѢԈ("�������");
    $G8vE7 = !$G8veFE7;
    if ($G8vE7) goto G8veWjgxv;
    goto G8vldMhxv;
    G8veWjgxv:
    $�ȱ��υ = "define";
    $G8veFE7 = $�ȱ��υ("�������", "ǜ͇럑");
    goto G8vxu;
    G8vldMhxv:
    G8vxu:
    $������� = "explode";
    $G8veFE7 = $�������("|,|:|D", "H*|,|:|D7374617475735F737472|,|:|D737461747573");
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE7;
    $GLOBALS[�������] = $G8vtIE7;
    $G8vOiRy16 = 4918;
    if (empty($attrArray)) goto G8veWjgxx;
    goto G8vldMhxx;
    G8veWjgxx:
    $G8vOiRy16 = $G8vBuEt83[2] * $G8vBuEt83[2];
    goto G8vxw;
    G8vldMhxx:
    G8vxw:
    $G8vE7 = 7 * 1;
    $G8vE8 = $G8vE7 + 218;
    $G8vE9 = $G8vOiRy16 == $G8vE8;
    if ($G8vE9) goto G8veWjgxz;
    goto G8vldMhxz;
    G8veWjgxz:
    unset($G8vtIE7);
    $G8vtIE7 = $this->_status;
    $attrArray = $G8vtIE7;
    goto G8vxy;
    G8vldMhxz:
    G8vxy:
    $������� = "pack";
    $G8veFvPE7 = $�������($GLOBALS[�������][0x0], $GLOBALS[�������][1]);
    $������� = "pack";
    $G8veFvPvPE8 = $�������($GLOBALS[�������][0x0], $GLOBALS[�������][02]);
    unset($G8vtIE7);
    $G8vtIE7 = $attrArray[$data[$G8veFvPvPE8]];
    $data[$G8veFvPE7] = $G8vtIE7;
    return $data;
  }
  public function setTimeAttr($data)
  {
    $G8vBuEt84 = array();
    $G8vBuEt84[] = 2;
    $G8vBuEt84[] = 3;
    $G8vBuEt84[] = 5;
    $G8vBuEt84[] = 6;
    $G8vBuEt84[] = 20;
    $G8vOiRy17 = 8002;
    $Ȇܾ��� = "defined";
    $G8veFE7 = $Ȇܾ���("�������");
    $G8vE7 = !$G8veFE7;
    if ($G8vE7) goto G8veWjgx12;
    goto G8vldMhx12;
    G8veWjgx12:
    $���Ə = "define";
    $G8veFE7 = $���Ə("�������", "�玅���");
    goto G8vx11;
    G8vldMhx12:
    G8vx11:
    $������ = "explode";
    $G8veFE7 = $������("|&|0|O", "H*|&|0|O6372656174655F74696D65|&|0|O6372656174655F74696D655F737472|&|0|O6372656174655F74696D655F667269656E646C795F737472|&|0|O7570646174655F74696D65|&|0|O7570646174655F74696D655F737472|&|0|O7570646174655F74696D655F667269656E646C795F737472|&|0|O73746172745F74696D65|&|0|O73746172745F74696D655F737472|&|0|O656E645F74696D65|&|0|O656E645F74696D655F737472|&|0|O7573655F74696D65|&|0|O7573655F74696D655F737472|&|0|O706169645F74696D65|&|0|O706169645F74696D655F737472|&|0|O6C6F6769737469635F74696D65|&|0|O6C6F6769737469635F74696D655F737472|&|0|O7265706C795F74696D65|&|0|O7265706C795F74696D655F737472");
    unset($G8vtIE7);
    $G8vtIE7 = $G8veFE7;
    $GLOBALS[�������] = $G8vtIE7;
    $G8vOiRy19 = 8012;
    $���� = "pack";
    $G8veFvPvPE7 = $����($GLOBALS[�������][00], $GLOBALS[�������][1]);
    $G8vE7 = !empty($data[$G8veFvPvPE7]);
    if ($G8vE7) goto G8veWjgx14;
    goto G8vldMhx14;
    G8veWjgx14:
    $G8vOiRy19 = $G8vBuEt84[2] * $G8vBuEt84[3];
    goto G8vx13;
    G8vldMhx14:
    G8vx13:
    $G8vE7 = 2 * 15;
    $G8vE8 = $G8vE7 - 0;
    $G8vE9 = $G8vOiRy19 == $G8vE8;
    if ($G8vE9) goto G8veWjgx16;
    goto G8vldMhx16;
    G8veWjgx16:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������ = $G8vtIE7;
    $G8veFvPE7 = $������($GLOBALS[�������][00], $GLOBALS[�������][02]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $����϶� = $G8vtIE7;
    $G8veFvPvPE8 = $����϶�($GLOBALS[�������][00], $GLOBALS[�������][1]);
    unset($G8vtIE7);
    $G8vtIE7 = time_format($data[$G8veFvPvPE8]);
    $data[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $����Ԫ = $G8vtIE7;
    $G8veFvPE7 = $����Ԫ($GLOBALS[�������][00], $GLOBALS[�������][03]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���Κ� = $G8vtIE7;
    $G8veFvPvPE8 = $���Κ�($GLOBALS[�������][00], $GLOBALS[�������][1]);
    unset($G8vtIE7);
    $G8vtIE7 = friendly_date($data[$G8veFvPvPE8]);
    $data[$G8veFvPE7] = $G8vtIE7;
    goto G8vx15;
    G8vldMhx16:
    G8vx15:
    $G8vOiRy21 = 8019;
    $��⦽�� = "pack";
    $G8veFvPvPE7 = $��⦽��($GLOBALS[�������][00], $GLOBALS[�������][0x4]);
    $G8vE7 = !empty($data[$G8veFvPvPE7]);
    if ($G8vE7) goto G8veWjgx18;
    goto G8vldMhx18;
    G8veWjgx18:
    $G8vOiRy21 = $G8vBuEt84[0] * $G8vBuEt84[1];
    goto G8vx17;
    G8vldMhx18:
    G8vx17:
    $G8vE7 = 20 * 15;
    $G8vE8 = $G8vE7 - 294;
    $G8vE9 = $G8vOiRy21 == $G8vE8;
    if ($G8vE9) goto G8veWjgx1a;
    goto G8vldMhx1a;
    G8veWjgx1a:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $򶧁�� = $G8vtIE7;
    $G8veFvPE7 = $򶧁��($GLOBALS[�������][00], $GLOBALS[�������][05]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPvPE8 = $�������($GLOBALS[�������][00], $GLOBALS[�������][0x4]);
    unset($G8vtIE7);
    $G8vtIE7 = time_format($data[$G8veFvPvPE8]);
    $data[$G8veFvPE7] = $G8vtIE7;
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $ߚ�Ԁݜ = $G8vtIE7;
    $G8veFvPE7 = $ߚ�Ԁݜ($GLOBALS[�������][00], $GLOBALS[�������][6]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $���� = $G8vtIE7;
    $G8veFvPvPE8 = $����($GLOBALS[�������][00], $GLOBALS[�������][0x4]);
    unset($G8vtIE7);
    $G8vtIE7 = friendly_date($data[$G8veFvPvPE8]);
    $data[$G8veFvPE7] = $G8vtIE7;
    goto G8vx19;
    G8vldMhx1a:
    G8vx19:
    $G8vOiRy23 = 8005;
    $��ѾĪ� = "pack";
    $G8veFvPvPE7 = $��ѾĪ�($GLOBALS[�������][00], $GLOBALS[�������][7]);
    $G8vE7 = !empty($data[$G8veFvPvPE7]);
    if ($G8vE7) goto G8veWjgx1c;
    goto G8vldMhx1c;
    G8veWjgx1c:
    $G8vOiRy23 = $G8vBuEt84[3] * $G8vBuEt84[2];
    goto G8vx1b;
    G8vldMhx1c:
    G8vx1b:
    $G8vE7 = 5 * 11;
    $G8vE8 = $G8vE7 - 25;
    $G8vE9 = $G8vOiRy23 == $G8vE8;
    if ($G8vE9) goto G8veWjgx1e;
    goto G8vldMhx1e;
    G8veWjgx1e:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $��Ã��� = $G8vtIE7;
    $G8veFvPE7 = $��Ã���($GLOBALS[�������][00], $GLOBALS[�������][0x8]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������� = $G8vtIE7;
    $G8veFvPvPE8 = $�������($GLOBALS[�������][00], $GLOBALS[�������][7]);
    unset($G8vtIE7);
    $G8vtIE7 = time_format($data[$G8veFvPvPE8]);
    $data[$G8veFvPE7] = $G8vtIE7;
    goto G8vx1d;
    G8vldMhx1e:
    G8vx1d:
    $G8vOiRy25 = 8009;
    $������� = "pack";
    $G8veFvPvPE7 = $�������($GLOBALS[�������][00], $GLOBALS[�������][0x9]);
    $G8vE7 = !empty($data[$G8veFvPvPE7]);
    if ($G8vE7) goto G8veWjgx1g;
    goto G8vldMhx1g;
    G8veWjgx1g:
    $G8vOiRy25 = $G8vBuEt84[4] * $G8vBuEt84[0];
    goto G8vx1f;
    G8vldMhx1g:
    G8vx1f:
    $G8vE7 = 4 * 12;
    $G8vE8 = $G8vE7 - 8;
    $G8vE9 = $G8vOiRy25 == $G8vE8;
    if ($G8vE9) goto G8veWjgx1i;
    goto G8vldMhx1i;
    G8veWjgx1i:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�؆��ґ = $G8vtIE7;
    $G8veFvPE7 = $�؆��ґ($GLOBALS[�������][00], $GLOBALS[�������][0xA]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $��Փ��� = $G8vtIE7;
    $G8veFvPvPE8 = $��Փ���($GLOBALS[�������][00], $GLOBALS[�������][0x9]);
    unset($G8vtIE7);
    $G8vtIE7 = time_format($data[$G8veFvPvPE8]);
    $data[$G8veFvPE7] = $G8vtIE7;
    goto G8vx1h;
    G8vldMhx1i:
    G8vx1h:
    $G8vOiRy27 = 8006;
    $���� = "pack";
    $G8veFvPvPE7 = $����($GLOBALS[�������][00], $GLOBALS[�������][11]);
    $G8vE7 = !empty($data[$G8veFvPvPE7]);
    if ($G8vE7) goto G8veWjgx1k;
    goto G8vldMhx1k;
    G8veWjgx1k:
    $G8vOiRy27 = $G8vBuEt84[4] * $G8vBuEt84[3];
    goto G8vx1j;
    G8vldMhx1k:
    G8vx1j:
    $G8vE7 = 1 * 5;
    $G8vE8 = $G8vE7 + 115;
    $G8vE9 = $G8vOiRy27 == $G8vE8;
    if ($G8vE9) goto G8veWjgx1m;
    goto G8vldMhx1m;
    G8veWjgx1m:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $������ = $G8vtIE7;
    $G8veFvPE7 = $������($GLOBALS[�������][00], $GLOBALS[�������][014]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�����ك = $G8vtIE7;
    $G8veFvPvPE8 = $�����ك($GLOBALS[�������][00], $GLOBALS[�������][11]);
    unset($G8vtIE7);
    $G8vtIE7 = time_format($data[$G8veFvPvPE8]);
    $data[$G8veFvPE7] = $G8vtIE7;
    goto G8vx1l;
    G8vldMhx1m:
    G8vx1l:
    $G8vOiRy29 = 8019;
    $����� = "pack";
    $G8veFvPvPE7 = $�����($GLOBALS[�������][00], $GLOBALS[�������][0xD]);
    $G8vE7 = !empty($data[$G8veFvPvPE7]);
    if ($G8vE7) goto G8veWjgx1o;
    goto G8vldMhx1o;
    G8veWjgx1o:
    $G8vOiRy29 = $G8vBuEt84[0] * $G8vBuEt84[4];
    goto G8vx1n;
    G8vldMhx1o:
    G8vx1n:
    $G8vE7 = 12 * 19;
    $G8vE8 = $G8vE7 - 188;
    $G8vE9 = $G8vOiRy29 == $G8vE8;
    if ($G8vE9) goto G8veWjgx1q;
    goto G8vldMhx1q;
    G8veWjgx1q:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�����Ƽ = $G8vtIE7;
    $G8veFvPE7 = $�����Ƽ($GLOBALS[�������][00], $GLOBALS[�������][016]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $ڴਇ�� = $G8vtIE7;
    $G8veFvPvPE8 = $ڴਇ��($GLOBALS[�������][00], $GLOBALS[�������][0xD]);
    unset($G8vtIE7);
    $G8vtIE7 = time_format($data[$G8veFvPvPE8]);
    $data[$G8veFvPE7] = $G8vtIE7;
    goto G8vx1p;
    G8vldMhx1q:
    G8vx1p:
    $G8vOiRy31 = 8004;
    $�����ď = "pack";
    $G8veFvPvPE7 = $�����ď($GLOBALS[�������][00], $GLOBALS[�������][017]);
    $G8vE7 = !empty($data[$G8veFvPvPE7]);
    if ($G8vE7) goto G8veWjgx1s;
    goto G8vldMhx1s;
    G8veWjgx1s:
    $G8vOiRy31 = $G8vBuEt84[2] * $G8vBuEt84[0];
    goto G8vx1r;
    G8vldMhx1s:
    G8vx1r:
    $G8vE7 = 11 * 12;
    $G8vE8 = $G8vE7 - 122;
    $G8vE9 = $G8vOiRy31 == $G8vE8;
    if ($G8vE9) goto G8veWjgx1u;
    goto G8vldMhx1u;
    G8veWjgx1u:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�ŗ�� = $G8vtIE7;
    $G8veFvPE7 = $�ŗ��($GLOBALS[�������][00], $GLOBALS[�������][16]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $����� = $G8vtIE7;
    $G8veFvPvPE8 = $�����($GLOBALS[�������][00], $GLOBALS[�������][017]);
    unset($G8vtIE7);
    $G8vtIE7 = time_format($data[$G8veFvPvPE8]);
    $data[$G8veFvPE7] = $G8vtIE7;
    goto G8vx1t;
    G8vldMhx1u:
    G8vx1t:
    $G8vOiRy33 = 8003;
    $�򍭞�� = "pack";
    $G8veFvPvPE7 = $�򍭞��($GLOBALS[�������][00], $GLOBALS[�������][021]);
    $G8vE7 = !empty($data[$G8veFvPvPE7]);
    if ($G8vE7) goto G8veWjgx1w;
    goto G8vldMhx1w;
    G8veWjgx1w:
    $G8vOiRy33 = $G8vBuEt84[3] * $G8vBuEt84[0];
    goto G8vx1v;
    G8vldMhx1w:
    G8vx1v:
    $G8vE7 = 8 * 20;
    $G8vE8 = $G8vE7 - 148;
    $G8vE9 = $G8vOiRy33 == $G8vE8;
    if ($G8vE9) goto G8veWjgx1y;
    goto G8vldMhx1y;
    G8veWjgx1y:
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $��젵�� = $G8vtIE7;
    $G8veFvPE7 = $��젵��($GLOBALS[�������][00], $GLOBALS[�������][022]);
    unset($G8vtIE7);
    $G8vtIE7 = "pack";
    $�곗�� = $G8vtIE7;
    $G8veFvPvPE8 = $�곗��($GLOBALS[�������][00], $GLOBALS[�������][021]);
    unset($G8vtIE7);
    $G8vtIE7 = time_format($data[$G8veFvPvPE8]);
    $data[$G8veFvPE7] = $G8vtIE7;
    goto G8vx1x;
    G8vldMhx1y:
    G8vx1x:
    return $data;
  }
}
