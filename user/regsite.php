<?php
/**
 * 自助开通分站
**/
$is_defend=true;
include("../includes/common.php");
if($islogin2==1 && $userrow['power']>0){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已开通过分站！');window.location.href='./';</script>");
}elseif($conf['fenzhan_buy']==0){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('当前站点未开启自助开通分站功能！');window.location.href='./';</script>");
}

if($is_fenzhan == true && $siterow['power']==2){
	if($siterow['ktfz_price']>0)$conf['fenzhan_price']=$siterow['ktfz_price'];
	if($conf['fenzhan_cost2']<=0)$conf['fenzhan_cost2']=$conf['fenzhan_price2'];
	if($siterow['ktfz_price2']>0 && $siterow['ktfz_price2']>=$conf['fenzhan_cost2'])$conf['fenzhan_price2']=$siterow['ktfz_price2'];
}
$title='自助开通分站';
include './head2.php';

$addsalt=md5(mt_rand(0,999).time());
$_SESSION['addsalt']=$addsalt;
$x = new \lib\hieroglyphy();
$addsalt_js = $x->hieroglyphyString($addsalt);

$kind = isset($_GET['kind'])?$_GET['kind']:0;

if($is_fenzhan == true && $siterow['power']==2 && !empty($siterow['ktfz_domain'])){
	$domains=explode(',',$siterow['ktfz_domain']);
}else{
	$domains=explode(',',$conf['fenzhan_domain']);
}
$select='';
foreach($domains as $domain){
	$select.='<option value="'.$domain.'">'.$domain.'</option>';
}
if(empty($select))showmsg('请先到后台分站设置，填写可选分站域名',3);
?>
  <link rel="stylesheet" href="<?php echo $cdnserver?>template/storenews/user/yangshi/my.css">
<?php if($background_image){?>
<img src="<?php echo $background_image;?>" alt="Full Background" class="full-bg full-bg-bottom animation-pulseSlow" ondragstart="return false;" oncontextmenu="return false;">
<?php }?>
<style>
    .block {
        margin: 0 0 0px;

        background-color: rgba(218, 224, 232, 0);

    }

    .list-group-item {
        border: 0px solid #ddd;
        padding: 5px 10px;

    }

    .list-group-item b {
        font-weight: 0;

    }

    .list-group-item img {
        width: 2.2rem;

    }

    .panel-default {
        border-color: rgba(218, 224, 232, 0);
        background-image: linear-gradient(to bottom, rgba(250, 166, 166, 1), rgba(236, 130, 173, 1));
        border-radius: 10px;
        padding-top: 5px;
        position: relative;
    }

    .panel-default .title-panel {
        top: 5px;
        position: absolute;
        width: 100%;
        height: 17%;
        left: 0%;
        z-index: 999;

    }

    .panel-default .title-panel .view {
        margin: auto;
        background: rgba(250, 166, 166, 1);
        width: 28%;
        height: 100%;
        border-radius: 5px; /* 设置圆角 */
        transform: perspective(10px) scale(1.2, 1.1) rotateX(-5deg);
        position: relative;
    }

    .panel-default .view-title {
        top: 8px;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        font-weight: 800;
    }

    .panel {
        background-color: rgba(218, 224, 232, 0);
        border: 0px solid transparent;
    }

    .fz-view {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;

    }

    .fz-view .fz-detail {
        width: 47%;
        height: 8rem;
        position: relative;
        border-radius: 12px;
        overflow: hidden;

    }

    .fz-view .fz-detail .fz-info {
        width: 100%;
        height: 90%;
        border-radius: 12px;
        position: relative;
        z-index: 9;
    }

    .fz-view .fz-detail .fz-bg {
        width: 95%;
        height: 50%;
        position: absolute;
        bottom: 0;
        left: 50%;
        z-index: 8;
        border-radius: 12px;
        transform: translateX(-50%);
        background: rgba(255, 255, 255, 0.8);
        /*filter: blur(20px);*/
        /*box-shadow: 0 0 5px 1px #fff;*/
    }

    .fz-view .fz-detail .fz-detail-bg {
        width: 100%;
        height: 150%;
        position: absolute;
        bottom: 0;
        left: 0;
        z-index: 10;

    }


</style>
<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block " style="float: none; background-color:#f2f2f2;padding:0">
    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
                <a href="../" class="btn btn-effect-ripple btn-default toggle-bordered enable-tooltip">返回首页</a>
            </div>
            <h2><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<b>自助开通分站</b></h2>
        </div>
        <div class="panel panel-default">
            <div class="title-panel">
                <div class="view"></div>
            </div>
            <div class="view-title">
                <img style="height:2.2rem" src="<?php echo $cdnserver?>template/storenews/user/assets/img/qiandao.png">
                <font style="font-size:1.3rem;">分站收入</font>
            </div>
            <marquee direction="up" behavior="scroll" loop="3" scrollamount="3" scrolldelay="8" align="top" hspace="10" vspace="7" onmouseover="this.stop()" onmouseout="this.start()" style="background-color:#ffffff; height: 150px; width:calc(100% - 20px) ;padding:0 12px">

                <a class="list-group-item">UID[3***1] ：<span>累计收益 <font color="red">1712</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***8] ：<span>累计收益 <font color="red">1741</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[1***2] ：<span>累计收益 <font color="red">1147</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***9] ：<span>累计收益 <font color="red">1441</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***2] ：<span>累计收益 <font color="red">2014</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[1***3] ：<span>累计收益 <font color="red">3171</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***5] ：<span>累计收益 <font color="red">7511</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[3***2] ：<span>累计收益 <font color="red">451</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***3] ：<span>累计收益 <font color="red">1451</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[7***8] ：<span>累计收益 <font color="red">1217</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[7***5] ：<span>累计收益 <font color="red">1414</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[1***1] ：<span>累计收益 <font color="red">823</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[8***9] ：<span>累计收益 <font color="red">9741</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***7] ：<span>累计收益 <font color="red">4142</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***1] ：<span>累计收益 <font color="red">3214</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***8] ：<span>累计收益 <font color="red">1899</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***1] ：<span>累计收益 <font color="red">471</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***4] ：<span>累计收益 <font color="red">8411</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[1***2] ：<span>累计收益 <font color="red">1101</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***9] ：<span>累计收益 <font color="red">441</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[1***3] ：<span>累计收益 <font color="red">971</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***5] ：<span>累计收益 <font color="red">1711</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[3***2] ：<span>累计收益 <font color="red">2412</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***3] ：<span>累计收益 <font color="red">7414</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[7***8] ：<span>累计收益 <font color="red">174</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[7***5] ：<span>累计收益 <font color="red">6144</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[1***1] ：<span>累计收益 <font color="red">823</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[1***1] ：<span>累计收益 <font color="red">123</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[7***9] ：<span>累计收益 <font color="red">914</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***7] ：<span>累计收益 <font color="red">4741</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***1] ：<span>累计收益 <font color="red">7331</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***8] ：<span>累计收益 <font color="red">8199</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***1] ：<span>累计收益 <font color="red">871</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***4] ：<span>累计收益 <font color="red">411</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***1] ：<span>累计收益 <font color="red">712</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***4] ：<span>累计收益 <font color="red">415</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[1***2] ：<span>累计收益 <font color="red">1411</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***9] ：<span>累计收益 <font color="red">4141</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[1***3] ：<span>累计收益 <font color="red">571</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[2***4] ：<span>累计收益 <font color="red">839</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[2***1] ：<span>累计收益 <font color="red">235</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[6***5] ：<span>累计收益 <font color="red">401</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[7***2] ：<span>累计收益 <font color="red">599</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***9] ：<span>累计收益 <font color="red">654</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[8***3] ：<span>累计收益 <font color="red">571</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***2] ：<span>累计收益 <font color="red">2101</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***9] ：<span>累计收益 <font color="red">441</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***3] ：<span>累计收益 <font color="red">871</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***5] ：<span>累计收益 <font color="red">531</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[6***2] ：<span>累计收益 <font color="red">670</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[3***3] ：<span>累计收益 <font color="red">414</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[7***8] ：<span>累计收益 <font color="red">317</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[7***2] ：<span>累计收益 <font color="red">614</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[7***1] ：<span>累计收益 <font color="red">243</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***1] ：<span>累计收益 <font color="red">800</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***9] ：<span>累计收益 <font color="red">600</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***7] ：<span>累计收益 <font color="red">1171</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***1] ：<span>累计收益 <font color="red">1331</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***8] ：<span>累计收益 <font color="red">180</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***1] ：<span>累计收益 <font color="red">871</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***4] ：<span>累计收益 <font color="red">414</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[2***1] ：<span>累计收益 <font color="red">522</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[2***4] ：<span>累计收益 <font color="red">887</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***2] ：<span>累计收益 <font color="red">445</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[2***9] ：<span>累计收益 <font color="red">1351</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[1***3] ：<span>累计收益 <font color="red">125</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[1***4] ：<span>累计收益 <font color="red">512</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[1***1] ：<span>累计收益 <font color="red">430</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[2***3] ：<span>累计收益 <font color="red">401</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***2] ：<span>累计收益 <font color="red">3599</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[1***9] ：<span>累计收益 <font color="red">150</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[3***3] ：<span>累计收益 <font color="red">555</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[6***1] ：<span>累计收益 <font color="red">520</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***8] ：<span>累计收益 <font color="red">283</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***1] ：<span>累计收益 <font color="red">871</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[9***4] ：<span>累计收益 <font color="red">457</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***1] ：<span>累计收益 <font color="red">541</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[7***4] ：<span>累计收益 <font color="red">888</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[7***2] ：<span>累计收益 <font color="red">440</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***9] ：<span>累计收益 <font color="red">300</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[3***3] ：<span>累计收益 <font color="red">125</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***4] ：<span>累计收益 <font color="red">500</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***1] ：<span>累计收益 <font color="red">430</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[2***3] ：<span>累计收益 <font color="red">401</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***2] ：<span>累计收益 <font color="red">599</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[5***9] ：<span>累计收益 <font color="red">150</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
                <a class="list-group-item">UID[4***3] ：<span>累计收益 <font color="red">421</font>  元   </span><img src="<?php echo $cdnserver?>template/storenews/user/assets/img/jinbi.png"></a>
            </marquee>
        </div>
        <div class="fz-view">
            <a class="fz-detail" href="#about" data-toggle="modal">
                <div class="fz-info display-row align-center justify-around" style="background-image:linear-gradient(to right, rgba(130, 193, 255, 1), rgba(148, 93, 246, 1));">
                    <div class="display-column" style="color: #eaeaea;">
                        <font size="2" color="#FFFFFF">分站</font>
                        <font size="1" style="padding-top: 5px;">详细介绍</font>
                    </div>
                    <img style="width: 4rem;height: 4rem;" src="<?php echo $cdnserver?>template/storenews/user/assets/img/jieshao.png">
                </div>
                <img class="fz-detail-bg" src="<?php echo $cdnserver?>template/storenews/user/assets/img/mengban.png">
                <div class="fz-bg"></div>
            </a>
            <a class="fz-detail" href="#userjs" data-toggle="modal">
                <div class="fz-info display-row align-center justify-around" style="background-image:linear-gradient(to right, rgba(252, 198, 108, 1), rgba(249, 138, 63, 1));">
                    <div class="display-column" style="color: #eaeaea;">
                        <font size="2" color="#FFFFFF">分站</font>
                        <font size="1" style="padding-top: 5px;">版本介绍</font>
                    </div>
                    <img style="width: 4rem;height: 4rem;" src="<?php echo $cdnserver?>template/storenews/user/assets/img/banben.png">
                </div>
                <img class="fz-detail-bg" src="<?php echo $cdnserver?>template/storenews/user/assets/img/mengban.png">
                <div class="fz-bg"></div>
   </a>
        </div>
        <br>
<form>
            <div class="my-cell">
                <div class="my-cell-title display-row justify-between align-center">
                    <div class="my-cell-title-l left-title">分站版本</div>
                    <a class="my-cell-title-r" style="color: #b6bcbd;" href="javascript:layer.alert('1.创业合伙人可以无限免费搭建下级网站,并且别人在你下级网站下单你还有提成赚！商品佣金每件最低6元起！<br>2.创业合伙人的商品成本价比初级站长更便宜，利润更多！<br>3.创业合伙人可自定义抽取下级同级别站长的订单佣金(最高20%)，无限躺赚！')">
                        <i class="fa fa-question-circle-o"></i> 分站规则
                    </a>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="form-control">初级站长 <font color="red">￥<?php echo $conf['fenzhan_price']?></font>
                        </div>
                        <span class="input-group-addon ">
                                  <input type="radio" name="kind" lay-skin="primary" value="1" checked="">
                                    
                                  </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="form-control">创业合伙人人 <font color="red">￥<?php echo $conf['fenzhan_price2']?></font>
                        </div>
                        <span class="input-group-addon">
                                    <input type="radio" name="kind" value="2">
                           
                                  </span>
                    </div>
                </div>
            </div>
            <div class="my-cell">
                <div class="my-cell-title display-row justify-between align-center">
                    <div class="my-cell-title-l left-title">分站名称</div>
                    <a class="my-cell-title-r" style="color: #b6bcbd;" href="javascript:layer.alert('&nbsp;例如：XX创业网,XX项目商城,XX资源网,自定义你想要的商城名字！')">
                        <i class="fa fa-question-circle-o"></i>
                    </a>
                </div>
                <div class="form-group form-group-radius">
                    <div class="input-group form-group-radius" style="width:100%">
                        <input type="text" name="name" id="name" class="form-control input-content" style="width:100%;border-radius: 50px;" required="" data-parsley-length="[2,10]" placeholder="输入网站名称">
                        <i class="fa fa-times-circle input-group-icon input-clear-a" style="pointer-events: auto;" onclick="$('#name').val('')"></i>
                    </div>

                </div>
                <div class="form-bottm-border"></div>
                <div class="my-cell-title display-row justify-between align-center">
                    <div class="my-cell-title-l left-title">二级域名</div>
                    <a class="my-cell-title-r" style="color: #b6bcbd;" href="javascript:layer.alert('可用字母，数字建议为2-5字，不能有标点符号（尽量简短,便于推广宣传）！')">
                        <i class="fa fa-question-circle-o"></i>
                    </a>
                </div>
                <div class="form-group form-group-radius">
                    <div class="input-group form-group-radius" style="width:100%">
                        <div class="input-group-addon">
                            自定前缀
                        </div>
                        <input type="text" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" name="qz" class="form-control " style="width:100%;border-radius: 50px;" required="" data-parsley-length="[2,8]" placeholder="输入你想要的二级前缀">
                        <i class="fa fa-refresh input-group-icon" style="color: #3793FF;font-size: 12px;" onclick="$('[name=\'qz\']').val(Math.random().toString(36).substr(6))"></i>
                    </div>

                </div>
                <div class="form-group form-group-radius">
                    <div class="input-group form-group-radius" style="width:100%">
                        <div class="input-group-addon">
                            选择后缀
                        </div>
                        <select name="domain" class="form-control"><?php echo $select?></select>
                    </div>

                </div>

            </div>

                            <div class="my-cell">
                    <div class="my-cell-title display-row justify-between align-center">
                        <div class="my-cell-title-l left-title">账号管理</div>
                        <a class="my-cell-title-r" style="color: #b6bcbd;" href="javascript:layer.alert('1.建议填写您的QQ号作为用户名，方便记住！<br>2.可以用字母或数字，密码不能低于6位！')">
                            <i class="fa fa-question-circle-o"></i>
                        </a>
                    </div>
                    <div class="form-group form-group-radius">
                        <div class="input-group  form-group-radius" style="width:100%">
                            <div class="input-group-addon">
                                管理账号
                            </div>
                            <input type="text" name="user" id="user" class="form-control input-content" style="width:100%;border-radius: 50px;" required="" placeholder="输入要注册的用户名">
                            <i class="fa fa-times-circle input-group-icon input-clear-a" style="pointer-events: auto;" onclick="$('#user').val('')"></i>
                        </div>

                    </div>
                    <div class="form-group form-group-radius">
                        <div class="input-group form-group-radius" style="width:100%">
                            <div class="input-group-addon">
                                管理密码
                            </div>
                            <input type="text" name="pwd" id="pwd" class="form-control input-content" style="width:100%;border-radius: 50px;" required="" placeholder="输入管理员密码">
                            <i class="fa fa-times-circle input-group-icon input-clear-a" style="pointer-events: auto;" onclick="$('#pwd').val('')"></i>
                        </div>

                    </div>
                    <div class="form-group form-group-radius">
                        <div class="input-group form-group-radius" style="width:100%">
                            <div class="input-group-addon">
                                绑定ＱＱ
                            </div>
                            <input type="number" name="qq" id="qq" class="form-control input-content" style="width:100%;border-radius: 50px;" required="" data-parsley-length="[5,10]" placeholder="输入你的QQ号">
                            <i class="fa fa-times-circle input-group-icon input-clear-a" style="pointer-events: auto;" onclick="$('#qq').val('')"></i>
                        </div>

                    </div>
                </div>
            

            <div class="form-group text-center" style="line-height:0">
                <label class="c-switch u-mr-small display-row align-center justify-center" style="margin-bottom: 14px;font-size: .75rem;">
                    <input class="c-switch__input" id="switch1" type="checkbox" on="" checked="">
                    <span class="c-switch__label" style="margin-left: 5px;margin-top: 3px;">
                                    <span class="d1 ">支付即视为您同意<a href="javascript:layer.alert('1.请你知悉并确认，会员服务为虚拟产品，开通分站会员服务后，若你中途主动取消服务或要求终止资格，你已支付的开通分站会员服务费用将不予退还，不支持退款。<hr>2.如你有其他与服务售后相关的问题，可以通过平台工单形式联系客服进行反馈。<hr>3.如使用会员服务过程中出现纠纷，你应当与本平台友好协商解决。<hr>4.建立合作关系后的合作有效期内，客户购买产品并支付订单为有效订单，您可获得推广提成。<hr>5.开通分站后务必在后台准确填写收款结算信息，佣金支持随时可结算，提现后，推广提成会结算至后台填写的收款账户中，推广费用以实际到账金额为准。', function() {$('#switch1').attr('checked','checked');layer.closeAll();})">《会员服务条款》</a>
                                    </span>
                                </span>
                </label>
            </div>


            <div class="text-center">
                <input type="button" id="submit_buy" value="创建分站" style="width: 80%;" class="btn submit_btn ">
            </div>

            <hr>
            <!-- <div class="form-group">
                <a href="findpwd.php" class="btn btn-info btn-rounded"><i class="fa fa-unlock"></i>&nbsp;找回密码</a>
                <a href="login.php" class="btn btn-primary btn-rounded" style="float:right;"><i class="fa fa-user"></i>&nbsp;返回登录</a>
            </div> -->
        </form>


<!--分站介绍开始-->
<div class="modal fade" align="left" id="userjs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="myModalLabel">版本介绍</h4>
		</div>
		<div class="block">
            <div class="table-responsive">
                <table class="table table-borderless table-vcenter">
                    <thead>
                        <tr>
                            <th style="width: 100px;">功能</th>
                            <th class="text-center" style="width: 20px;">普及版/专业版</th>
                        </tr>
                    </thead>
					<tbody>
						<tr class="active">
                            <td>专属商城平台</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="success">
                            <td>专属网站域名</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>赚取用户提成</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="info">
                            <td>赚取下级分站提成</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>设置商品价格</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="warning">
                            <td>设置下级分站商品价格</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="">
                            <td>搭建下级分站</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
						<tr class="danger">
                            <td>赠送专属APP</td>
                            <td class="text-center">
								<span class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-close"></i></span>
								<span class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-check"></i></span>
							</td>
                        </tr>
                    </tbody>
                </table>
            </div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		</div>
    </div>
  </div>
</div>
<!--分站介绍结束-->

<div class="modal fade" align="left" id="about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">详细介绍</h4>
		</div>
		<div class="modal-body">
			<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">分站是怎么获取收益的？</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							其实很简单，你只需要把你的分站域名发给你的用户让他下单，一旦下单付款成功，你的账户就会增加你所赚差价的金额，自己是可以设置销售价格的哦！
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">赚到的钱在哪里？我如何得到？</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							分站后台有完整的消费明细和余额信息，后台余额可供您在平台消费，满<?php echo $conf['tixian_min']; ?>元可以在后台提现到QQ钱包微信或者支付宝中。
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">需要我自己供货吗？哪来的商品货源？</a>
						</h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							所有商品全部由主站提供，您无需当心货源问题，所有订单由我们来处理，如果网站没有您想要的商品可联系主站客服添加即可！
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed" aria-expanded="false">可以自己上架商品吗？可以修改售价吗？</a>
						</h4>
					</div>
					<div id="collapseFive" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							所有分站都不支持自己上架商品，但可以修改销售价格！
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" class="collapsed" aria-expanded="false">那么多网站有分站，为什么选择你们呢？</a>
						</h4>
					</div>
					<div id="collapseSix" class="panel-collapse collapse" style="height: 0px;" aria-expanded="false">
						<div class="panel-body">
							全网最专业的商城系统，商品齐全、货源稳定、价格低廉、售后保障。实体工作室运营，拥有丰富的人脉和资源，我们的货源全部精挑细选全网性价比最高的，实时掌握市场的动态，加入我们，只要你坚持，你不用担心不赚钱，不用担心货源不好，更不用担心我们跑路，我们即使不敢保证你月入上万，在网上赚个零花钱绝对没问题！
						</div>
					</div>
				</div>
			</div>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script>
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script src="../assets/js/regsite.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>