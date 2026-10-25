<?php
// South Bay Cyber Decks — landing page, single file.
// Works two ways: (1) as plain HTML/JS in any browser, (2) under PHP, where
// the lead form below is validated server-side and priced with the same
// numbers as the JavaScript configurator. No database, no external assets,
// no build step. Prices are STARTING ESTIMATES, not final quotes.
$BASE = 450;
$computes = [
  ['id'=>'pi5','name'=>'Raspberry Pi 5 · 8 GB','price'=>0,'tag'=>'Best value','desc'=>'Huge software support. Radio, SDR, coding, retro, and everyday computing.'],
  ['id'=>'orin','name'=>'Jetson Orin Nano Super · 8 GB','price'=>250,'tag'=>'On-device AI','desc'=>'CUDA + vision. For AI workloads the Pi cannot touch. Needs a cooling call — we confirm it on your build sheet.'],
  ['id'=>'byo','name'=>'Bring your own board','price'=>-80,'tag'=>'You ship it','desc'=>'You send the board, we design the deck around it. Price drops by the board we do not supply.'],
];
$displays = [
  ['id'=>'4','name'=>'4″ touchscreen — small decks','price'=>55],
  ['id'=>'7','name'=>'7″ touchscreen','price'=>90],['id'=>'10','name'=>'10″ IPS','price'=>140],
  ['id'=>'13','name'=>'13″ IPS','price'=>210],['id'=>'none','name'=>'No display — headless / you supply','price'=>0],
];
$batteries = [
  ['id'=>'standard','name'=>'Standard battery','price'=>0,'desc'=>'A full working day for light use.'],
  ['id'=>'extended','name'=>'Extended battery','price'=>90,'desc'=>'Longer runtime, a little more weight.'],
  ['id'=>'hotswap','name'=>'Hot-swap dual battery','price'=>160,'desc'=>'Swap packs without shutting down. Field favourite.'],
];
$cases = [
  ['id'=>'vintage','name'=>'Vintage Terminal','emoji'=>'🕹️','price'=>220,'color'=>'#e8dcc0','material'=>'ABS / printed shell · metal badge','best'=>'Typewriter wedge · round caps','trade'=>'Bigger, heavier, unmistakable.','desc'=>'Old-school computer energy. Beige, chunky bezels, visible screws, typewriter keys. Looks like it time-travelled from 1983.'],
  ['id'=>'sleek','name'=>'Sleek','emoji'=>'✨','price'=>260,'color'=>'#2b3440','material'=>'CNC / bent aluminium · optional acrylic window','best'=>'Foldable clamshell · low-profile caps','trade'=>'Less room for big antennas and batteries.','desc'=>'Thin aluminium, minimal seams, muted colours. The deck you can open in a coffee shop without starting a conversation — unless you want one.'],
  ['id'=>'tactical','name'=>'Tactical / Field','emoji'=>'🎒','price'=>340,'color'=>'#5a6b3f','material'=>'Pelican-style shell · aluminium frame · rubber seals','best'=>'Luggable · chunky caps · LoRa + GPS','trade'=>'Heaviest family, priciest seals.','desc'=>'Rugged, handles, sealed edges, mounting points. For field work, ham radio, and off-grid days. Drop it, splash it, keep working.'],
  ['id'=>'hidden','name'=>'Hidden / Stealth','emoji'=>'📕','price'=>300,'color'=>'#7a4a2b','material'=>'Book cloth / leatherette · briefcase shell · hidden hinges','best'=>'Book form · slim SB-40 / SB-50','trade'=>'Thermals and screen size are constrained by the disguise.','desc'=>'Looks like a book, a briefcase, or a toolbox. Closed, nobody knows. Open, it is a full computer.'],
  ['id'=>'exposed','name'=>'Exposed / Cyberpunk','emoji'=>'⚡','price'=>280,'color'=>'#c98f2e','material'=>'Acrylic + brass standoffs · open aluminium frame','best'=>'Slab · SB-Macro · backlit caps','trade'=>'No weather protection. Dust is a lifestyle.','desc'=>'Open frame, visible boards, brass and acrylic. A showpiece for maker fairs and your desk. If you want people to ask questions, start here.'],
  ['id'=>'luggable','name'=>'Luggable','emoji'=>'🧳','price'=>320,'color'=>'#8a8f94','material'=>'Suitcase shell · aluminium frame · carry handle','best'=>'Luggable form · SB-75 · extra battery','trade'=>'You will feel it in your shoulder.','desc'=>'Suitcase-style, bigger screen, bigger battery. A portable workstation, not a pocket toy. The one you bring when the work matters more than the weight.'],
];
$forms = [
  ['id'=>'foldable','name'=>'Foldable clamshell','price'=>60,'desc'=>'Laptop-style hinge. Screen folds onto the keyboard.'],
  ['id'=>'slab','name'=>'Slab + detachable keyboard','price'=>0,'desc'=>'Tablet slab. Keyboard detaches or magnet-mounts.'],
  ['id'=>'typewriter','name'=>'Typewriter wedge','price'=>80,'desc'=>'All-in-one wedge, screen tilted at the back.'],
  ['id'=>'luggable','name'=>'Luggable / suitcase','price'=>70,'desc'=>'Case opens: screen in the lid, deck in the base.'],
  ['id'=>'split','name'=>'Split two-piece','price'=>40,'desc'=>'Keyboard splits. Screen unit separate.'],
  ['id'=>'book','name'=>'Book / hidden','price'=>50,'desc'=>'Disguised cover. Opens like a book.'],
];
$boards = [
  ['id'=>'SB-40','name'=>'SB-40 Pocket','keys'=>'~40','layout'=>'Ortholinear 4×10','price'=>140,'rows'=>[10,10,10,10]],
  ['id'=>'SB-50','name'=>'SB-50 Compact','keys'=>'~50','layout'=>'Ortholinear 5×10','price'=>150,'rows'=>[10,10,10,10,10]],
  ['id'=>'SB-60','name'=>'SB-60 Classic','keys'=>'61','layout'=>'Staggered','price'=>160,'rows'=>[14,14,13,12,8]],
  ['id'=>'SB-65','name'=>'SB-65','keys'=>'68','layout'=>'Staggered + arrows','price'=>175,'rows'=>[15,15,14,13,11]],
  ['id'=>'SB-75','name'=>'SB-75','keys'=>'82','layout'=>'Staggered + F-row','price'=>195,'rows'=>[16,16,16,15,14]],
  ['id'=>'SB-Ortho48','name'=>'SB-Ortho 48','keys'=>'48','layout'=>'Ortholinear 4×12','price'=>155,'rows'=>[12,12,12,12]],
  ['id'=>'SB-Split36','name'=>'SB-Split 36','keys'=>'36','layout'=>'Split ergo 3×6 × 2','price'=>180,'rows'=>[12,12,12]],
  ['id'=>'SB-Type','name'=>'SB-Typewriter','keys'=>'60','layout'=>'Vintage staggered, round-cap ready','price'=>190,'rows'=>[13,13,12,11,9]],
  ['id'=>'SB-Track','name'=>'SB-Track','keys'=>'61 + pad bay','layout'=>'Staggered + built-in pad bay','price'=>210,'rows'=>[14,14,13,12,8]],
  ['id'=>'SB-Macro','name'=>'SB-Macro','keys'=>'61 + macros','layout'=>'Staggered + macro column + knobs','price'=>200,'rows'=>[15,15,14,13,10]],
];
$touchpads = [
  ['id'=>'none','name'=>'No touchpad','price'=>0,'desc'=>'Cleanest and lightest. Pair with a mouse.'],
  ['id'=>'side','name'=>'Side touchpad bay','price'=>45,'desc'=>'Pad to the right of the keys. Typing area untouched.'],
  ['id'=>'center','name'=>'Center touchpad','price'=>55,'desc'=>'Below the spacebar, laptop-style. Needs SB-60 or larger.'],
  ['id'=>'trackball','name'=>'Trackball','price'=>65,'desc'=>'34 mm ball, right side. Field decks, gloves.'],
  ['id'=>'stick','name'=>'Pointing stick / nub','price'=>35,'desc'=>'Nub between the keys. Compact and split decks.'],
];
$caps = [
  ['id'=>'low','name'=>'Low-profile, backlit','price'=>0],['id'=>'chunky','name'=>'Chunky tactile','price'=>0],
  ['id'=>'vintage','name'=>'Vintage round typewriter caps','price'=>20],['id'=>'blank','name'=>'Blank / custom legends','price'=>0],
];
$accessories = [
  ['id'=>'esp32lcd','name'=>'ESP32 + LCD status module','price'=>65,'desc'=>'Battery, network and system stats on a second tiny screen.'],
  ['id'=>'esp32second','name'=>'Second ESP32 coprocessor','price'=>55,'desc'=>'Dedicated radio / sensor / automation board.'],
  ['id'=>'lora','name'=>'LoRa module + antenna','price'=>45,'desc'=>'Long-range mesh and messaging.'],
  ['id'=>'wifi','name'=>'High-gain Wi-Fi antenna','price'=>35,'desc'=>'External and swappable.'],
  ['id'=>'gps','name'=>'GPS module + antenna','price'=>40,'desc'=>'Position, time, and field logging.'],
  ['id'=>'sdr','name'=>'SDR receiver','price'=>55,'desc'=>'Receive-only radio exploration.'],
  ['id'=>'seconddisplay','name'=>'Second small display','price'=>75,'desc'=>'Status terminal or notes screen.'],
  ['id'=>'solar','name'=>'Solar input','price'=>85,'desc'=>'Regulator + panel mount. Field charging.'],
  ['id'=>'engrave','name'=>'Custom engraving / nameplate','price'=>30,'desc'=>'Your name, callsign, or deck name.'],
];
function by_id($list,$id){foreach($list as $x){if($x['id']===$id)return $x;}return null;}
function estimate_php($cfg){
  global $BASE,$computes,$displays,$batteries,$cases,$forms,$boards,$touchpads,$caps,$accessories;
  $t=$BASE;
  foreach([[$computes,'compute'],[$displays,'display'],[$batteries,'battery'],[$cases,'case'],[$forms,'form']] as $pair){$r=by_id($pair[0],$cfg[$pair[1]]??'');if($r)$t+=$r['price'];}
  $b=by_id($boards,$cfg['board']??'');if($b)$t+=$b['price'];
  $tp=by_id($touchpads,$cfg['touchpad']??'');if($tp)$t+=$tp['price'];
  $cp=by_id($caps,$cfg['keycaps']??'');if($cp)$t+=$cp['price'];
  foreach(($cfg['accessories']??[]) as $a){$r=by_id($accessories,$a);if($r)$t+=$r['price'];}
  if(($cfg['finish']??'')==='custom')$t+=40;
  return $t;
}
function build_code_php($cfg){
  // Readable, deterministic, and identical to the JavaScript buildCode():
  // SB-<compute>-<case3>-<form3>-<board>-<pointer2>
  $short=['pi5'=>'PI5','orin'=>'ORN','byo'=>'BYO'];
  $tp=['none'=>'NO','side'=>'SD','center'=>'CT','trackball'=>'TB','stick'=>'ST'];
  $c=$short[$cfg['compute']??'']??'??';
  $ca=strtoupper(substr($cfg['case']??'',0,3));
  $fo=strtoupper(substr($cfg['form']??'',0,3));
  $bd=str_replace('-','',$cfg['board']??'');
  $t=$tp[$cfg['touchpad']??'']??'NO';
  return 'SB-'.$c.'-'.$ca.'-'.$fo.'-'.$bd.'-'.$t;
}
function e($s){return htmlspecialchars((string)$s,ENT_QUOTES,'UTF-8');}
function money($n){return '$'.number_format((int)$n);}
// Lead form (POST to this same file). Stateless by design: we validate,
// price server-side, and show the confirmation + a mailto link. Nothing
// is silently stored, and no payment is taken here.
$lead_ok=null;$lead_err='';$lead_name='';$lead_email='';$lead_notes='';$lead_build=null;
if(($_SERVER['REQUEST_METHOD']??'')==='POST' && ($_POST['form']??'')==='lead'){
  $lead_name=trim($_POST['name']??'');$lead_email=trim($_POST['email']??'');$lead_notes=trim($_POST['notes']??'');
  $raw=$_POST['build_json']??'';$decoded=json_decode($raw,true);
  if($lead_name===''||$lead_email===''||!filter_var($lead_email,FILTER_VALIDATE_EMAIL)){$lead_err='Please add your name and a valid email so we can reply with your quote.';}
  elseif(!is_array($decoded)||empty($decoded['compute'])||empty($decoded['case'])||empty($decoded['board'])){$lead_err='Your build did not come through — please rebuild it in the configurator above and try again.';}
  else{$decoded['estimate_usd']=estimate_php($decoded);$decoded['build_code']=build_code_php($decoded);$lead_build=$decoded;$lead_ok=true;}
}
$examples=[
  ['name'=>'The Vintage Writer','code'=>'vintage','cfg'=>['compute'=>'pi5','display'=>'10','battery'=>'standard','case'=>'vintage','form'=>'typewriter','board'=>'SB-Type','touchpad'=>'none','keycaps'=>'vintage','finish'=>'standard','accessories'=>['esp32lcd','lora']],'blurb'=>'Beige wedge, round caps, LoRa + status LCD. The deck that looks like 1983 and works like today.'],
  ['name'=>'The Field Operator','code'=>'tactical','cfg'=>['compute'=>'orin','display'=>'10','battery'=>'hotswap','case'=>'tactical','form'=>'luggable','board'=>'SB-65','touchpad'=>'trackball','keycaps'=>'chunky','finish'=>'standard','accessories'=>['esp32lcd','esp32second','wifi','gps']],'blurb'=>'Orin Nano for on-device AI, hot-swap batteries, trackball for gloves. Built for off-grid days.'],
  ['name'=>'The Stealth Book','code'=>'hidden','cfg'=>['compute'=>'pi5','display'=>'7','battery'=>'standard','case'=>'hidden','form'=>'book','board'=>'SB-40','touchpad'=>'none','keycaps'=>'low','finish'=>'standard','accessories'=>['esp32lcd']],'blurb'=>'Closes like a book, opens like a computer. Small board, small screen, nobody asks questions.'],
  ['name'=>'The Pocket Four','code'=>'pocket','cfg'=>['compute'=>'pi5','display'=>'4','battery'=>'standard','case'=>'sleek','form'=>'foldable','board'=>'SB-40','touchpad'=>'none','keycaps'=>'low','finish'=>'standard','accessories'=>['esp32lcd']],'blurb'=>'The small deck: 4″ screen, SB-40 keyboard, compact case that shrinks to fit. Pocketable, not pocket-sized hype.'],
];
foreach($examples as &$ex){$ex['total']=estimate_php($ex['cfg']);$ex['build_code']=build_code_php($ex['cfg']);}
unset($ex);
$data_for_js=['base'=>$BASE,'computes'=>$computes,'displays'=>$displays,'batteries'=>$batteries,'cases'=>$cases,'forms'=>$forms,'boards'=>$boards,'touchpads'=>$touchpads,'caps'=>$caps,'accessories'=>$accessories,'examples'=>$examples];
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>South Bay Cyber Decks — Custom cyberdecks, built around you</title>
<meta name="description" content="Custom-built cyberdecks: Raspberry Pi or Jetson Orin Nano, six case families, six forms, and a custom keyboard PCB cut to fit your deck. You design it, we bring it to life.">
<meta property="og:title" content="South Bay Cyber Decks">
<meta property="og:description" content="You design it. We bring it to life. Custom cyberdecks with custom keyboard PCBs.">
<meta property="og:type" content="website">
<style>
:root{--bg:#0a0f0d;--panel:#121a16;--panel2:#18231e;--line:#2a3d32;--green:#39ff9a;--green2:#1fd67f;--amber:#ffb454;--cyan:#5eead4;--text:#eaf2ec;--muted:#9fb3a6;--radius:16px}
*{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;background:var(--bg);color:var(--text);font-family:system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;line-height:1.55}
a{color:var(--green)}a:focus-visible,button:focus-visible,input:focus-visible,select:focus-visible,textarea:focus-visible{outline:3px solid var(--green);outline-offset:2px}
.skip{position:absolute;left:-9999px}.skip:focus{left:12px;top:12px;background:var(--green);color:#04120a;padding:8px 12px;border-radius:8px;z-index:99}
nav{position:sticky;top:0;z-index:50;background:rgba(10,15,13,.92);backdrop-filter:blur(8px);border-bottom:1px solid var(--line)}
.nav-in{max-width:1180px;margin:0 auto;padding:12px 20px;display:flex;align-items:center;gap:18px;flex-wrap:wrap}
.logo{font-weight:900;letter-spacing:.02em;text-decoration:none;color:var(--text);font-size:1.05rem}.logo b{color:var(--green)}
.nav-links{margin-left:auto;display:flex;gap:16px;flex-wrap:wrap}.nav-links a{color:var(--muted);text-decoration:none}.nav-links a:hover{color:var(--text)}
.btn{display:inline-block;background:var(--green);color:#04120a;font-weight:800;text-decoration:none;padding:12px 18px;border-radius:12px;border:0;cursor:pointer}.btn:hover{background:var(--green2)}.btn.ghost{background:transparent;color:var(--green);border:1px solid var(--green)}
.wrap{max-width:1180px;margin:0 auto;padding:0 20px}
.hero{padding:56px 0 32px;display:grid;grid-template-columns:1.15fr .85fr;gap:28px;align-items:start}
@media(max-width:900px){.hero{grid-template-columns:1fr}}
.eyebrow{font-family:ui-monospace,Menlo,monospace;color:var(--green);letter-spacing:.1em;text-transform:uppercase;font-size:.8rem}
h1{font-size:clamp(2.4rem,6vw,4.2rem);line-height:1.02;margin:12px 0}h1 span{color:var(--green)}h2{font-size:clamp(1.6rem,3.5vw,2.3rem);line-height:1.15;margin:0 0 10px}h3{margin:0 0 6px}
.lede{color:var(--muted);font-size:1.15rem;max-width:640px}.muted{color:var(--muted)}
.hero-card{background:linear-gradient(160deg,#16241c,#0e1a13);border:1px solid var(--line);border-radius:20px;padding:20px}
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:22px}
@media(max-width:700px){.stats{grid-template-columns:repeat(2,1fr)}}
.stat{border:1px solid var(--line);border-radius:14px;padding:14px;background:var(--panel)}.stat b{font-size:1.7rem;color:var(--green);display:block}.stat span{color:var(--muted);font-size:.9rem}
section{padding:44px 0}section.alt{background:#0d1411;border-top:1px solid var(--line);border-bottom:1px solid var(--line)}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:16px}
.card{background:var(--panel);border:1px solid var(--line);border-radius:var(--radius);padding:18px}
.card:hover{border-color:#3d5c4b}
.filters{display:flex;gap:8px;flex-wrap:wrap;margin:16px 0}
.chip{border:1px solid var(--line);background:var(--panel);color:var(--text);border-radius:999px;padding:8px 14px;cursor:pointer}.chip.on{background:var(--green);color:#04120a;font-weight:700;border-color:var(--green)}
.case-emoji{font-size:2.2rem}.case-swatch{height:10px;border-radius:99px;margin:12px 0}
table{width:100%;border-collapse:collapse}th,td{text-align:left;padding:10px;border-bottom:1px solid var(--line);vertical-align:top}th{color:var(--muted);font-size:.9rem}
.scrollx{overflow-x:auto}
.builder{display:grid;grid-template-columns:1fr 380px;gap:22px;align-items:start}
@media(max-width:950px){.builder{grid-template-columns:1fr}}
fieldset{border:1px solid var(--line);border-radius:var(--radius);padding:16px;margin:0 0 16px;background:var(--panel)}legend{font-weight:800;padding:0 8px}
.opt{display:flex;gap:10px;align-items:flex-start;padding:11px;border:1px solid var(--line);border-radius:12px;margin:8px 0;cursor:pointer;background:var(--panel2)}
.opt:hover,.opt:has(input:checked){border-color:var(--green)}.opt input{margin-top:4px;accent-color:var(--green)}.opt small{color:var(--muted);display:block}
label.sel{display:block;margin:10px 0}label.sel>span{display:block;font-weight:700;margin-bottom:5px}
select,input[type=text],input[type=email],textarea{width:100%;padding:11px;border-radius:10px;background:#0d1411;color:var(--text);border:1px solid var(--line);font:inherit}
textarea{min-height:90px}
.summary{position:sticky;top:70px;background:#0f1f17;border:1px solid var(--green);border-radius:20px;padding:20px}
.price{font-size:2.4rem;font-weight:900;color:var(--green);line-height:1}
.breakdown{font-size:.92rem}.breakdown div{display:flex;justify-content:space-between;gap:12px;padding:3px 0;border-bottom:1px dashed #24382d}.breakdown div:last-child{border:0}
.deck-preview{border:1px solid var(--line);border-radius:14px;padding:16px;background:#0a120e;margin:14px 0;text-align:center}
.deck-screen{height:86px;border-radius:10px;margin:0 auto 10px;display:flex;align-items:center;justify-content:center;font-family:ui-monospace,monospace;font-size:.8rem;color:#04120a;font-weight:700}
.deck-base{height:34px;border-radius:0 0 12px 12px;margin:0 auto;background:#1e2f26}
.kb-preview{border:1px solid var(--line);border-radius:12px;padding:12px;background:#0a120e;margin:12px 0}
.kb-row{display:flex;gap:4px;margin-bottom:4px}.kb-key{flex:1;height:22px;border-radius:5px;background:#24382d;border:1px solid #3a5c49}.kb-key.space{flex:4}
.kb-pad{height:34px;border:2px solid var(--cyan);border-radius:8px;margin-top:8px;display:flex;align-items:center;justify-content:center;color:var(--cyan);font-size:.75rem}
.kb-ball{width:34px;height:34px;border-radius:50%;background:var(--cyan);margin:8px 0 0 auto}
pre{white-space:pre-wrap;word-break:break-word;background:#07100c;border:1px solid var(--line);border-radius:12px;padding:12px;font-size:.8rem;color:#c8e6d5;max-height:300px;overflow:auto}
.faq-item{border:1px solid var(--line);border-radius:12px;margin:10px 0;background:var(--panel)}.faq-q{width:100%;text-align:left;background:transparent;border:0;color:var(--text);font:inherit;font-weight:700;padding:16px;cursor:pointer}.faq-a{padding:0 16px 16px;color:var(--muted);display:none}.faq-item.open .faq-a{display:block}
.alert{border-radius:12px;padding:14px;margin:14px 0}.alert.ok{background:#123a24;border:1px solid var(--green)}.alert.err{background:#3a1414;border:1px solid #ff6b6b}
.note{color:var(--muted);font-size:.9rem}kbd{font-family:ui-monospace,monospace;background:#1e2f26;padding:2px 6px;border-radius:4px}
footer{border-top:1px solid var(--line);padding:28px 0;color:var(--muted);font-size:.9rem}
.step-num{display:inline-flex;width:28px;height:28px;border-radius:50%;background:var(--green);color:#04120a;font-weight:900;align-items:center;justify-content:center;margin-right:8px}
.cut-diagram{display:flex;gap:6px;flex-wrap:wrap;margin-top:12px}.cut-diagram span{border-radius:8px;padding:8px 10px;font-size:.85rem}.keep{background:#3a2323;border:1px solid #ff6b6b}.trim{background:#123a24;border:1px solid var(--green)}
@media(prefers-reduced-motion:reduce){html{scroll-behavior:auto}}
@media print{nav,.hero,.filters,.btn,footer{display:none!important}.builder{grid-template-columns:1fr}.summary{position:static}}
.three-wrap{border:1px solid var(--line);border-radius:14px;padding:10px;background:#0a120e;margin:14px 0}
#deck3d{width:100%;height:300px;display:block;border-radius:10px;background:radial-gradient(ellipse at 50% 30%,#1a2b20,#0a120e 70%);touch-action:none}
.viewer-bar{display:flex;gap:8px;flex-wrap:wrap;margin-top:10px}.viewer-bar button{flex:1;min-width:110px;padding:8px;border-radius:9px;border:1px solid var(--line);background:var(--panel2);color:var(--text);cursor:pointer}.viewer-bar button.on{background:var(--green);color:#04120a;font-weight:700}
model-viewer{width:100%;height:420px;background:#0a120e;border:1px solid var(--line);border-radius:16px}
.asset-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:12px;margin-top:16px}
</style>
<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>
<script type="importmap">{"imports":{"three":"https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.module.js","three/addons/":"https://cdn.jsdelivr.net/npm/three@0.160.0/examples/jsm/"}}</script>
</head>
<body>
<a class="skip" href="#builder">Skip to the builder</a>
<nav><div class="nav-in">
<a class="logo" href="#">SOUTH BAY <b>CYBER DECKS</b></a>
<div class="nav-links"><a href="#cases">Cases</a><a href="#keyboards">Keyboards</a><a href="#builder">Builder</a><a href="#process">Process</a><a href="#faq">FAQ</a></div>
<a class="btn" href="#builder">Build yours →</a>
</div></nav>
<main class="wrap">
<section class="hero">
<div>
<p class="eyebrow">South Bay IT Solutions · Made to order</p>
<h1>You design it.<br><span>We bring it to life.</span></h1>
<p class="lede">Most cyberdecks force you into one mini keyboard and one box. We do the opposite: pick your computer, your case, your keyboard shape — down to where the keys go — and we hand-build that exact deck.</p>
<p><a class="btn" href="#builder">Start building →</a> &nbsp; <a class="btn ghost" href="#cases">See the cases</a></p>
<p class="note">Prices below are starting estimates for planning. Your final quote is confirmed, in writing, before we cut anything. No payment is taken on this page.</p>
<div class="stats">
<div class="stat"><b>6</b><span>case families</span></div>
<div class="stat"><b>10</b><span>keyboard PCB platforms</span></div>
<div class="stat"><b>5</b><span>pointer options, incl. none</span></div>
<div class="stat"><b>1</b><span>deck — yours, not a kit</span></div>
</div>
</div>
<div class="hero-card">
<p class="eyebrow">What you are actually buying</p>
<h3 style="font-size:1.4rem">Not a kit. A deck built around you.</h3>
<p class="muted">A cyberdeck is personal — it should fit your hands, your bag, and your work. So we start from your choices, not from a warehouse shelf:</p>
<ul>
<li><b>Computer first:</b> Raspberry Pi 5 for value and software, or Jetson Orin Nano for on-device AI.</li>
<li><b>Case second:</b> vintage, sleek, tactical, hidden, exposed, or luggable — then the form it opens as.</li>
<li><b>Keyboard third, and most important:</b> a custom PCB, cut to fit your case, keys placed for you, touchpad only if you want one.</li>
<li><b>Accessories last:</b> ESP32s with LCDs, antennas, SDR, GPS, extra power.</li>
</ul>
<p class="note">Every deck ships with a build sheet and keyboard map, so you — or we — can repair and mod it later.</p>
</div>
</section>

<section id="cases">
<h2>Case families — pick a vibe, then make it yours</h2>
<p class="muted">A family is a look and build style. A form factor (in the builder) is how it opens and carries. Mix them: a Sleek book, a Tactical clamshell, a Vintage typewriter wedge — all normal orders.</p>
<div class="filters" role="group" aria-label="Filter cases">
<button class="chip on" data-filter="all">All families</button>
<?php foreach($cases as $c): ?><button class="chip" data-filter="<?= e($c['id']) ?>"><?= e($c['emoji']) ?> <?= e($c['name']) ?></button><?php endforeach; ?>
</div>
<div class="grid" id="caseGrid">
<?php foreach($cases as $c): ?>
<article class="card" data-case="<?= e($c['id']) ?>">
<div class="case-emoji"><?= e($c['emoji']) ?></div><h3><?= e($c['name']) ?></h3>
<div class="case-swatch" style="background:<?= e($c['color']) ?>"></div>
<p class="muted"><?= e($c['desc']) ?></p>
<p><small><b>Material:</b> <?= e($c['material']) ?><br><b>Pairs with:</b> <?= e($c['best']) ?><br><b>Trade-off:</b> <?= e($c['trade']) ?></small></p>
<p><b>Case from <?= money($c['price']) ?></b> <span class="muted">+ form + rest of build</span></p>
<button class="btn ghost" data-load-case="<?= e($c['id']) ?>">Use this case in the builder ↓</button>
</article>
<?php endforeach; ?>
</div>
</section>

<section class="alt"><div class="wrap" style="padding:0">
<h2>Pi or Orin Nano? The honest comparison</h2>
<div class="scrollx"><table>
<tr><th></th><th>Raspberry Pi 5 · 8 GB</th><th>Jetson Orin Nano Super · 8 GB</th></tr>
<tr><td><b>Pick it for</b></td><td>Value, software, radio, SDR, coding, retro</td><td>On-device AI, CUDA, computer vision</td></tr>
<tr><td><b>Software</b></td><td>The biggest ecosystem. Almost everything just runs.</td><td>NVIDIA stack. Best when your workload is actually AI.</td></tr>
<tr><td><b>Power / heat</b></td><td>Easy to cool and power. Long battery life.</td><td>More power, more heat. We confirm cooling on your build sheet.</td></tr>
<tr><td><b>Price in builder</b></td><td>Included in base</td><td>+<?= money(250) ?></td></tr>
<tr><td><b>Wrong for</b></td><td>Heavy local AI / vision at speed</td><td>A simple terminal / radio deck where a Pi is plenty</td></tr>
</table></div>
<p class="note">Rule of thumb: if you have to ask whether you need the Orin, you probably want the Pi — and you can say so in the build notes and we will tell you straight.</p>
</div></section>

<section id="keyboards">
<h2>The keyboard is the whole point</h2>
<p class="lede" style="color:var(--muted)">Cyberdecks are getting popular, and there is still basically one mini keyboard everyone reuses. That is the gap. We build the keyboard around the deck — and around your hands.</p>
<div class="grid" style="margin-top:18px">
<div class="card"><h3>✂️ Cut to fit</h3><p class="muted">Each platform has documented cut zones. We trim the outline to your case instead of forcing your case around a stock board.</p><div class="cut-diagram"><span class="keep">■ Keep-out: MCU, USB-C, pad bay</span><span class="trim">■ Free trim: edges, corners, thumb clusters</span></div></div>
<div class="card"><h3>⌨️ Keys where you want them</h3><p class="muted">Ortholinear, staggered, split, or typewriter layouts, placed on a 19.05&nbsp;mm grid. Move a cluster, drop a key, add a thumb row — if it stays on grid and out of keep-outs, we can route it.</p></div>
<div class="card"><h3>🖱️ With or without a touchpad</h3><p class="muted">None, side bay, center pad, trackball, or pointing stick. The pad is a bay in the PCB outline, not a stuck-on module — so the case cutout actually matches.</p></div>
<div class="card"><h3>🔌 Real keyboard specs</h3><p class="muted">RP2040 (STM32 on request), USB-C, QMK / ZMK, hotswap sockets, per-key RGB optional, 1.6&nbsp;mm FR4. Fine per-key placement comes from our separate PCB designer app — see the builder notes.</p></div>
</div>
<h3 style="margin-top:28px">The 10 base PCB platforms</h3>
<div class="scrollx"><table>
<tr><th>Board</th><th>Keys</th><th>Layout</th><th>From</th></tr>
<?php foreach($boards as $b): ?><tr><td><b><?= e($b['id']) ?></b> — <?= e($b['name']) ?></td><td><?= e($b['keys']) ?></td><td><?= e($b['layout']) ?></td><td><?= money($b['price']) ?></td></tr><?php endforeach; ?>
</table></div>
<p class="note">Keyboard preview in the builder is schematic, not to scale. Your routed layout is confirmed on your build sheet before fabrication.</p>
</section>

<section id="displays">
<h2>Displays — including the new 4″ for smaller decks</h2>
<p class="muted">Screens are now modelled at their true 16:9 size in both the 3D viewer and the GLB files — a 4″ screen really is smaller, and picking it shrinks the whole deck case in the preview and in the assembled-build GLB, instead of leaving a big empty shell around a tiny screen. Resolutions below are typical for that size class; the exact panel is confirmed on your build sheet.</p>
<div class="scrollx"><table>
<tr><th>Size</th><th>Typical panel</th><th>Best for</th><th>In builder</th></tr>
<tr><td><b>4″ touchscreen</b></td><td>~800×480, touch</td><td>Pocket / hidden decks, status + terminal, SB-40 builds</td><td>+$55 · compact case</td></tr>
<tr><td><b>7″ touchscreen</b></td><td>~1024×600, touch</td><td>Book / slab decks, field terminals</td><td>+$90</td></tr>
<tr><td><b>10″ IPS</b></td><td>~1280×800</td><td>The default — clamshells, luggables, everyday work</td><td>+$140</td></tr>
<tr><td><b>13″ IPS</b></td><td>~1920×1080</td><td>Portable workstations, big-screen luggables</td><td>+$210</td></tr>
<tr><td><b>No display</b></td><td>—</td><td>Headless decks, or you supply your own panel</td><td>+$0</td></tr>
</table></div>
<p class="note">Display work in this update: true diagonal sizes everywhere (4″ = 89×50 mm, 7″ = 155×87 mm, 10″ = 221×124 mm, 13″ = 288×162 mm), thinner bezels, a cleaner screen UI in 3D (simplified on the 4″ so text stays readable), and a compact-case rule for 4″ builds.</p>
</section>

<section id="3d">
<h2>3D assets — every piece, every build, in real 3D</h2>
<p class="muted">Two ways to see it. In the builder below, the 3D deck rebuilds live as you change case, keyboard, display, and accessories — drag to orbit, scroll to zoom, try Exploded view to see the pieces separate. Here, you can inspect any single asset file on its own — and now, clicking <b>View in 3D canvas</b> on any asset below loads that GLB straight into the rotating builder canvas (the one with your deck in it), so you see it at full size with orbit + auto-rotate. Click <b>Back to my build</b> there to return to your configurator deck. All 37 GLB files live in the repo under <kbd>assets/models/</kbd> (metres, Y-up), generated by <kbd>tools/build-3d-assets.py</kbd>, and open in Blender, model-viewer, and any GLTF viewer.</p>
<?php $man=json_decode(@file_get_contents(__DIR__.'/../assets/models/manifest.json'),true); $models=($man['models']??[]); ?>
<?php if($models): ?>
<label class="sel"><span>Inspect a single asset</span><select id="assetSelect">
<?php foreach($models as $m): ?><option value="../<?= e($m['file']) ?>" <?= $m['id']==='build-vintage-writer'?'selected':'' ?>><?= e(ucfirst($m['category'])) ?> — <?= e($m['name']) ?> (<?= number_format($m['bytes']/1024,1) ?> KB)</option><?php endforeach; ?>
</select></label>
<model-viewer id="assetViewer" src="../assets/models/builds/build-vintage-writer.glb" camera-controls auto-rotate shadow-intensity="1" alt="3D model of a South Bay cyberdeck build"></model-viewer>
<p class="note">Drag to orbit · Scroll to zoom · Right-drag to pan. <a id="assetDownload" href="../assets/models/builds/build-vintage-writer.glb" download>Download this GLB</a></p>
<button class="btn" type="button" id="assetToCanvas">View selected asset in the builder 3D canvas ↓</button>
<div class="asset-grid">
<?php foreach($models as $m): ?><div class="card"><b><?= e($m['name']) ?></b><p class="muted" style="margin:4px 0"><?= e(ucfirst($m['category'])) ?> · <?= number_format($m['bytes']/1024,1) ?> KB · <?= (int)$m['meshes'] ?> meshes<br><kbd><?= e($m['file']) ?></kbd></p><a href="../<?= e($m['file']) ?>" download>Download GLB ↓</a> · <button type="button" class="chip" data-view-glb="../<?= e($m['file']) ?>" data-glb-label="<?= e($m['name']) ?>">View in 3D canvas →</button></div><?php endforeach; ?>
</div>
<?php else: ?>
<p class="note">Asset manifest not found when this page was rendered — the GLB files are still in <kbd>assets/models/</kbd> in the repo. Serve this page from the repo root (see README) so the manifest loads.</p>
<model-viewer src="../assets/models/builds/build-vintage-writer.glb" camera-controls auto-rotate shadow-intensity="1" alt="3D model of a South Bay cyberdeck build"></model-viewer>
<?php endif; ?>
<script>
document.addEventListener('DOMContentLoaded',function(){var s=document.getElementById('assetSelect');var v=document.getElementById('assetViewer');var d=document.getElementById('assetDownload');if(s&&v){s.addEventListener('change',function(){v.setAttribute('src',s.value);if(d)d.setAttribute('href',s.value);});}
function viewInCanvas(url,label){if(window.loadDeckGLB){window.loadDeckGLB(url,label);document.getElementById('builder').scrollIntoView({behavior:'smooth'});}else{alert('The 3D canvas is still loading — please try again in a second.');}}
var toCanvas=document.getElementById('assetToCanvas');if(toCanvas){toCanvas.addEventListener('click',function(){var sel=document.getElementById('assetSelect');var opt=sel?sel.options[sel.selectedIndex]:null;viewInCanvas(sel?sel.value:'../assets/models/builds/build-vintage-writer.glb',opt?opt.text:'asset');});}
document.querySelectorAll('[data-view-glb]').forEach(function(btn){btn.addEventListener('click',function(){viewInCanvas(btn.getAttribute('data-view-glb'),btn.getAttribute('data-glb-label')||'asset');});});});
</script>
</section>

<section id="builder" class="alt"><div class="wrap" style="padding:0">
<h2><span class="step-num">▸</span>Build your deck</h2>
<p class="muted">Work top to bottom. The preview, price breakdown, and Build Code on the right update live. Try an example below first if you want a starting point — then change anything.</p>
<div style="display:flex;gap:10px;flex-wrap:wrap;margin:16px 0">
<?php foreach($examples as $ex): ?><button class="chip" data-load-example="<?= e($ex['code']) ?>">Load: <?= e($ex['name']) ?> · from <?= money($ex['total']) ?></button><?php endforeach; ?>
</div>
<div class="builder">
<div>
<fieldset><legend>1 · Computer + display + battery</legend>
<?php foreach($computes as $c): ?><label class="opt"><input type="radio" name="compute" value="<?= e($c['id']) ?>" <?= $c['id']==='pi5'?'checked':'' ?>><span><b><?= e($c['name']) ?> <?= $c['price']?($c['price']>0?'+'.money($c['price']):'−'.money(abs($c['price']))):'· included' ?></b><small><?= e($c['tag']) ?> — <?= e($c['desc']) ?></small></span></label><?php endforeach; ?>
<label class="sel"><span>Display</span><select id="display"><?php foreach($displays as $d): ?><option value="<?= e($d['id']) ?>" <?= $d['id']==='10'?'selected':'' ?>><?= e($d['name']) ?> — <?= $d['price']?'+'.money($d['price']):'included' ?></option><?php endforeach; ?></select></label>
<label class="sel"><span>Battery</span><select id="battery"><?php foreach($batteries as $b): ?><option value="<?= e($b['id']) ?>"><?= e($b['name']) ?> — <?= $b['price']?'+'.money($b['price']):'included' ?> · <?= e($b['desc']) ?></option><?php endforeach; ?></select></label>
</fieldset>

<fieldset><legend>2 · Case + form + finish</legend>
<label class="sel"><span>Case family</span><select id="case"><?php foreach($cases as $c): ?><option value="<?= e($c['id']) ?>" <?= $c['id']==='sleek'?'selected':'' ?>><?= e($c['emoji']) ?> <?= e($c['name']) ?> — +<?= money($c['price']) ?></option><?php endforeach; ?></select></label>
<label class="sel"><span>Form factor — how it opens / carries</span><select id="form"><?php foreach($forms as $f): ?><option value="<?= e($f['id']) ?>" <?= $f['id']==='foldable'?'selected':'' ?>><?= e($f['name']) ?> — <?= $f['price']?'+'.money($f['price']):'included' ?> · <?= e($f['desc']) ?></option><?php endforeach; ?></select></label>
<label class="sel"><span>Finish</span><select id="finish"><option value="standard" selected>Standard finish for this family — included</option><option value="matte">Matte black — included</option><option value="custom">Custom colour / finish — +$40</option></select></label>
<p class="note">Form and family are independent. Want a hybrid (e.g. Sleek book, Tactical clamshell)? Pick the closest and say so in the lead form notes.</p>
</fieldset>

<fieldset><legend>3 · Keyboard — the custom part</legend>
<label class="sel"><span>Base PCB platform (cut to fit your case)</span><select id="board"><?php foreach($boards as $b): ?><option value="<?= e($b['id']) ?>" <?= $b['id']==='SB-60'?'selected':'' ?>><?= e($b['id']) ?> <?= e($b['name']) ?> — <?= e($b['keys']) ?> keys, <?= e($b['layout']) ?> — +<?= money($b['price']) ?></option><?php endforeach; ?></select></label>
<label class="sel"><span>Touchpad / pointer</span><select id="touchpad"><?php foreach($touchpads as $t): ?><option value="<?= e($t['id']) ?>" <?= $t['id']==='none'?'selected':'' ?>><?= e($t['name']) ?> — <?= $t['price']?'+'.money($t['price']):'included' ?> · <?= e($t['desc']) ?></option><?php endforeach; ?></select></label>
<label class="sel"><span>Keycaps</span><select id="caps"><?php foreach($caps as $c): ?><option value="<?= e($c['id']) ?>" <?= $c['id']==='chunky'?'selected':'' ?>><?= e($c['name']) ?> — <?= $c['price']?'+'.money($c['price']):'included' ?></option><?php endforeach; ?></select></label>
<p class="note">Fine key placement — shaping the board outline, moving keys, per-key map — is done in our separate PCB designer app (in development). This builder reserves the platform + touchpad bay; the designer export plugs into the build JSON as <kbd>keyboard.designer_export</kbd> (see the repo's <kbd>configurator/build-config.schema.json</kbd>).</p>
</fieldset>

<fieldset><legend>4 · Accessories</legend>
<?php foreach($accessories as $a): ?><label class="opt"><input type="checkbox" class="acc" value="<?= e($a['id']) ?>" data-price="<?= (int)$a['price'] ?>"><span><b><?= e($a['name']) ?> — +<?= money($a['price']) ?></b><small><?= e($a['desc']) ?></small></span></label><?php endforeach; ?>
<p class="note">Transmitting gear is your responsibility to operate legally (licences, bands, local rules). We build the hardware; you own the airwaves compliance.</p>
</fieldset>
</div>

<aside class="summary" aria-label="Build summary">
<div class="eyebrow">Your build · live</div>
<div class="price" id="price">$—</div>
<p class="note" style="margin:4px 0 0">Starting estimate (*). Final quote confirmed before cutting.</p>
<div class="three-wrap">
<canvas id="deck3d" aria-label="Interactive 3D preview of your cyberdeck — drag to orbit, scroll to zoom"></canvas>
<div class="viewer-bar">
<button type="button" id="viewReset">Reset view</button>
<button type="button" id="viewRotate" class="on">Auto-rotate: on</button>
<button type="button" id="viewExploded">Exploded view</button>
<button type="button" id="viewTop">Top view</button>
<button type="button" id="viewMyBuild" style="display:none">← Back to my build</button>
</div>
<div class="note" id="deckLabel" style="margin-top:8px"></div>
<div class="note" id="threeStatus">3D loading… if it stays here, your connection blocked the 3D library — the keyboard schematic below still shows your layout.</div>
</div>
<div class="kb-preview" aria-label="Keyboard schematic preview">
<div id="kbKeys"></div><div id="kbPointer"></div>
<div class="note">Keyboard schematic, not to scale.</div>
</div>
<div class="breakdown" id="breakdown"></div>
<p><b>Build Code:</b> <kbd id="buildCode">—</kbd></p>
<button class="btn" id="copyBtn" type="button" style="width:100%">Copy build summary + JSON</button>
<button class="btn ghost" id="dlBtn" type="button" style="width:100%;margin-top:8px">Download build JSON</button>
<button class="btn ghost" id="shareBtn" type="button" style="width:100%;margin-top:8px">Copy share link</button>
<button class="btn ghost" id="printBtn" type="button" style="width:100%;margin-top:8px" onclick="window.print()">Print build sheet</button>
<p class="note" id="copyMsg"></p>
<pre id="jsonOut"></pre>
</aside>
</div>
</div></section>

<section id="process">
<h2>How it works — no surprises</h2>
<div class="grid">
<div class="card"><h3><span class="step-num">1</span>You build it here</h3><p class="muted">Configurator → Build Code. No account, no payment yet.</p></div>
<div class="card"><h3><span class="step-num">2</span>We confirm it</h3><p class="muted">We check fit, power, thermals, and keyboard layout, then send a final quote + build sheet. Nothing is cut until you approve it.</p></div>
<div class="card"><h3><span class="step-num">3</span>We build it</h3><p class="muted">Case, custom keyboard PCB, wiring, test, burn-in. Progress photos along the way.</p></div>
<div class="card"><h3><span class="step-num">4</span>It ships</h3><p class="muted">With its build sheet and keyboard map, so you (or we) can repair and mod it later.</p></div>
</div>
</section>

<section id="start" class="alt"><div class="wrap" style="padding:0">
<h2>Start your build — send us the Build Code</h2>
<p class="muted">Fill this in and your current configurator build is attached automatically. We reply with a confirmed quote and build sheet. This form takes no payment and, on plain static hosting, the confirmation below is your record — save or download it.</p>
<?php if($lead_ok && $lead_build): ?>
<div class="alert ok"><b>✓ Received in this session — thank you, <?= e($lead_name) ?>.</b><br>
Build Code: <kbd><?= e($lead_build['build_code']) ?></kbd> · Server-checked estimate: <b><?= money($lead_build['estimate_usd']) ?>*</b><br>
<span class="muted">Next step: we would confirm display, battery, keyboard layout, and final price before cutting. On a live PHP host, wire this form to email/CRM; until then, use the mailto link below to send it to us.</span><br><br>
<a class="btn" href="mailto:?subject=<?= rawurlencode('South Bay Cyber Deck build '.$lead_build['build_code']) ?>&amp;body=<?= rawurlencode($lead_name.' ('.$lead_email.') — Build '.$lead_build['build_code'].' — $'.$lead_build['estimate_usd'].'*'.chr(10).json_encode($lead_build,JSON_PRETTY_PRINT).chr(10).'Notes: '.$lead_notes) ?>">Send this build by email →</a>
<pre><?= e(json_encode($lead_build,JSON_PRETTY_PRINT)) ?></pre></div>
<?php endif; ?>
<?php if($lead_err): ?><div class="alert err"><?= e($lead_err) ?></div><?php endif; ?>
<form method="post" action="#start" id="leadForm">
<input type="hidden" name="form" value="lead">
<input type="hidden" name="build_json" id="buildJsonField" value="">
<label class="sel"><span>Your name</span><input type="text" name="name" required value="<?= e($lead_name) ?>" placeholder="e.g. Alex Rivera"></label>
<label class="sel"><span>Email (so we can send your quote)</span><input type="email" name="email" required value="<?= e($lead_email) ?>" placeholder="you@example.com"></label>
<label class="sel"><span>Notes — bag it must fit, colour, left-handed, quiet switches, anything else</span><textarea name="notes" placeholder="e.g. Must fit my 15L backpack. Quiet switches, library use."><?= e($lead_notes) ?></textarea></label>
<button class="btn" type="submit">Send my build for a confirmed quote →</button>
<p class="note">Estimates only. No charge, no obligation. We do not share your email.</p>
</form>
</div></section>

<section id="faq">
<h2>Questions, answered straight</h2>
<?php $faqs=[
 ['Can I really shape the keyboard?','Yes — within the platform\'s cut zones. Trim the outline, move keys on the grid, add a thumb row. The routed layout is confirmed on your build sheet before fabrication. Wild shapes outside keep-outs (MCU, USB-C, pad bay) need a quick feasibility check.'],
 ['Do I have to have a touchpad?','No. “No touchpad” is a first-class option, not a missing feature. Many field decks skip it for a trackball, a stick, or a mouse.'],
 ['Pi or Orin Nano — which should I pick?','Pi for value and software. Orin for on-device AI and vision. If you are unsure, pick Pi and tell us the workload in the notes — we will say straight if the Orin is worth it.'],
 ['How long does a build take?','Depends on case machining and keyboard routing. We give a delivery estimate with your confirmed quote, not a vague promise here, and send progress photos.'],
 ['What if my deck breaks later?','It ships with a build sheet and keyboard map, so parts are identifiable and replaceable. Workmanship terms are confirmed with your quote — draft terms are in the repo under docs/ordering.md.'],
 ['Can I supply my own parts?','Yes — bring-your-own board is a configurator option, and you can supply a display, battery, or radio if it fits safely. Tell us in the notes and we will quote around it.'],
]; foreach($faqs as $i=>$f): ?>
<div class="faq-item"><button class="faq-q" type="button" aria-expanded="false"><?= e($f[0]) ?> <span style="float:right">+</span></button><div class="faq-a"><?= e($f[1]) ?></div></div>
<?php endforeach; ?>
</section>
</main>
<footer><div class="wrap">
<p><b style="color:var(--text)">South Bay Cyber Decks</b> · A South Bay IT Solutions project · Repo: <a href="https://github.com/lalomorales22/South-Bay-Cyber-Decks">github.com/lalomorales22/South-Bay-Cyber-Decks</a></p>
<p>All prices are starting estimates (*). Final quote, warranty terms, and delivery date are confirmed in writing before any build begins. Keyboard previews are schematics, not fabrication drawings.</p>
</div></footer>
<script>
const DATA = <?= json_encode($data_for_js, JSON_UNESCAPED_SLASHES) ?>;
const $ = id => document.getElementById(id);
const find = (list,id) => list.find(x=>x.id===id);
const fmt = n => '$' + n.toLocaleString();
function getState(){
  const acc=[]; document.querySelectorAll('.acc:checked').forEach(c=>acc.push(c.value));
  return {compute:document.querySelector('input[name=compute]:checked').value, display:$('display').value, battery:$('battery').value, case:$('case').value, form:$('form').value, board:$('board').value, touchpad:$('touchpad').value, keycaps:$('caps').value, finish:$('finish').value, accessories:acc};
}
function setState(s){
  if(s.compute){document.querySelector('input[name=compute][value="'+s.compute+'"]').checked=true;}
  ['display','battery','case','form','board','touchpad','caps','finish'].forEach(k=>{ if(s[k] && $(k)) $(k).value = (k==='touchpad'? s.touchpad : (k==='caps'? s.keycaps : s[k])); });
  // caps/touchpad mapping above: board etc use same id, caps id is 'caps', touchpad id is 'touchpad'
  if(s.keycaps) $('caps').value=s.keycaps; if(s.touchpad) $('touchpad').value=s.touchpad;
  document.querySelectorAll('.acc').forEach(c=>c.checked=(s.accessories||[]).includes(c.value));
  update();
}
function buildCode(s){
  const short={pi5:'PI5',orin:'ORN',byo:'BYO'};
  const board=(s.board||'').replace('-','');
  const tp={none:'NO',side:'SD',center:'CT',trackball:'TB',stick:'ST'}[s.touchpad]||'NO';
  return 'SB-'+(short[s.compute]||'??')+'-'+(s.case||'').slice(0,3).toUpperCase()+'-'+(s.form||'').slice(0,3).toUpperCase()+'-'+board+'-'+tp;
}
function renderKeyboard(s){
  const b=find(DATA.boards,s.board); if(!b) return;
  let html='';
  b.rows.forEach((n,ri)=>{
    let keys='';
    if(s.board==='SB-Split36'){
      const left=Math.ceil(n/2), right=n-left;
      keys='<span style="display:flex;gap:4px;flex:1">'+'<i class="kb-key"></i>'.repeat(left)+'</span><span style="width:14px"></span><span style="display:flex;gap:4px;flex:1">'+'<i class="kb-key"></i>'.repeat(right)+'</span>';
      html+='<div class="kb-row">'+keys+'</div>';
    } else {
      for(let i=0;i<n;i++){ const isSpace=(ri===b.rows.length-1 && i===Math.floor(n/2)); html+=''; keys+='<i class="kb-key'+(isSpace?' space':'')+'"></i>'; }
      html+='<div class="kb-row">'+keys+'</div>';
    }
  });
  $('kbKeys').innerHTML=html;
  let p='';
  if(s.touchpad==='side') p='<div class="kb-pad" style="margin-left:auto;width:28%">touchpad</div>';
  else if(s.touchpad==='center') p='<div class="kb-pad" style="width:42%;margin:8px auto 0">touchpad</div>';
  else if(s.touchpad==='trackball') p='<div class="kb-ball" title="trackball"></div><div class="note" style="text-align:right">trackball</div>';
  else if(s.touchpad==='stick') p='<div style="text-align:center"><span style="display:inline-block;width:14px;height:14px;border-radius:50%;background:var(--cyan);margin-top:8px"></span><div class="note">pointing stick</div></div>';
  $('kbPointer').innerHTML=p;
}
function update(){
  const s=getState();
  const comp=find(DATA.computes,s.compute), disp=find(DATA.displays,s.display), batt=find(DATA.batteries,s.battery), cs=find(DATA.cases,s.case), fm=find(DATA.forms,s.form), bd=find(DATA.boards,s.board), tp=find(DATA.touchpads,s.touchpad), cp=find(DATA.caps,s.keycaps);
  let total=DATA.base, lines=[];
  const add=(label,price)=>{ total+=price; lines.push([label,price]); };
  lines.push(['Base build — labour, wiring, test',DATA.base]);
  add('Computer — '+comp.name, comp.price); add('Display — '+disp.name, disp.price); add('Battery — '+batt.name, batt.price);
  add('Case — '+cs.name, cs.price); add('Form — '+fm.name, fm.price); add('Keyboard — '+bd.id+' '+bd.name, bd.price);
  add('Pointer — '+tp.name, tp.price); add('Keycaps — '+cp.name, cp.price);
  if(s.finish==='custom') add('Finish — custom colour', 40);
  s.accessories.forEach(a=>{ const r=find(DATA.accessories,a); if(r) add('Accessory — '+r.name, r.price); });
  $('price').textContent=fmt(total)+'*';
  $('breakdown').innerHTML=lines.map(l=>'<div><span>'+l[0]+'</span><b>'+(l[1]===0?'incl.':(l[1]>0?'+'+fmt(l[1]):'−'+fmt(Math.abs(l[1]))))+'</b></div>').join('');
  const code=buildCode(s); $('buildCode').textContent=code;
  const ds=$('deckScreen'); if(ds){ds.style.background=cs.color; ds.textContent=cs.name.toUpperCase()+' · '+disp.name.toUpperCase();}
  $('deckLabel').textContent=cs.name+' · '+fm.name+' · '+bd.id+' keyboard'+(s.touchpad!=='none'?' · '+tp.name:' · no touchpad')+(s.display==='none'?' · headless':' · '+disp.name);
  if(window.updateDeck3D) window.updateDeck3D(s);
  renderKeyboard(s);
  const build={version:1,product:'south-bay-cyber-deck',...s,estimate_usd:total,build_code:code};
  $('jsonOut').textContent=JSON.stringify(build,null,2);
  const hf=$('buildJsonField'); if(hf) hf.value=JSON.stringify(build);
  return build;
}
document.querySelectorAll('input,select').forEach(e=>e.addEventListener('change',update));
document.querySelectorAll('[data-filter]').forEach(btn=>btn.addEventListener('click',()=>{
  document.querySelectorAll('[data-filter]').forEach(b=>b.classList.remove('on')); btn.classList.add('on');
  const f=btn.dataset.filter; document.querySelectorAll('#caseGrid [data-case]').forEach(card=>{ card.style.display=(f==='all'||card.dataset.case===f)?'':'none'; });
}));
document.querySelectorAll('[data-load-case]').forEach(btn=>btn.addEventListener('click',()=>{ $('case').value=btn.dataset.loadCase; update(); document.getElementById('builder').scrollIntoView({behavior:'smooth'}); }));
document.querySelectorAll('[data-load-example]').forEach(btn=>btn.addEventListener('click',()=>{
  const ex=DATA.examples.find(e=>e.code===btn.dataset.loadExample); if(ex) setState(ex.cfg);
  document.getElementById('builder').scrollIntoView({behavior:'smooth'});
}));
document.querySelectorAll('.faq-q').forEach(q=>q.addEventListener('click',()=>{ const item=q.parentElement; const open=item.classList.toggle('open'); q.setAttribute('aria-expanded',open); }));
$('copyBtn').onclick=async()=>{ const b=update(); const t=document.getElementById('price').textContent+'\nBuild Code: '+b.build_code+'\n\n'+JSON.stringify(b,null,2); try{await navigator.clipboard.writeText(t);$('copyMsg').textContent='Copied — paste it into the lead form notes or an email to us.';}catch(e){$('copyMsg').textContent='Copy blocked — select the JSON below manually.';} };
$('dlBtn').onclick=()=>{ const b=update(); const a=document.createElement('a'); a.href=URL.createObjectURL(new Blob([JSON.stringify(b,null,2)],{type:'application/json'})); a.download='south-bay-cyberdeck-build.json'; a.click(); };
$('shareBtn').onclick=async()=>{ const b=update(); const url=location.origin+location.pathname+'#build='+encodeURIComponent(JSON.stringify(b)); try{await navigator.clipboard.writeText(url);$('copyMsg').textContent='Share link copied — opening it restores this exact build.';}catch(e){location.hash='build='+encodeURIComponent(JSON.stringify(b));$('copyMsg').textContent='Share link is now in the address bar.';} };
(function restoreFromHash(){
  try{ const m=location.hash.match(/build=([^&]+)/); if(m){ const cfg=JSON.parse(decodeURIComponent(m[1])); setState(cfg); return; } }catch(e){}
  update();
})();
</script>
<script type="module">
import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { RoundedBoxGeometry } from 'three/addons/geometries/RoundedBoxGeometry.js';
import { RoomEnvironment } from 'three/addons/environments/RoomEnvironment.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
const canvas=document.getElementById('deck3d'); const statusEl=document.getElementById('threeStatus');
if(canvas){
  const renderer=new THREE.WebGLRenderer({canvas, antialias:true, alpha:true});
  renderer.setPixelRatio(Math.min(devicePixelRatio,2)); renderer.shadowMap.enabled=true; renderer.shadowMap.type=THREE.PCFSoftShadowMap;
  renderer.toneMapping=THREE.ACESFilmicToneMapping; renderer.toneMappingExposure=1.1; renderer.outputColorSpace=THREE.SRGBColorSpace;
  const scene=new THREE.Scene();
  const pmrem=new THREE.PMREMGenerator(renderer); scene.environment=pmrem.fromScene(new RoomEnvironment(),0.04).texture;
  const camera=new THREE.PerspectiveCamera(38,1,0.01,10); camera.position.set(0.55,0.48,0.62);
  const controls=new OrbitControls(camera,canvas); controls.enableDamping=true; controls.dampingFactor=0.08; controls.minDistance=0.25; controls.maxDistance=1.6; controls.maxPolarAngle=Math.PI*0.52; controls.autoRotate=true; controls.autoRotateSpeed=0.9;
  scene.add(new THREE.HemisphereLight(0xffffff,0x1a2b20,0.7));
  const key=new THREE.DirectionalLight(0xffffff,2.2); key.position.set(0.6,1,0.5); key.castShadow=true; key.shadow.mapSize.set(2048,2048); key.shadow.camera.left=-0.5; key.shadow.camera.right=0.5; key.shadow.camera.top=0.5; key.shadow.camera.bottom=-0.5; scene.add(key);
  const rim=new THREE.DirectionalLight(0x5eead4,0.8); rim.position.set(-0.6,0.4,-0.6); scene.add(rim);
  const ground=new THREE.Mesh(new THREE.CircleGeometry(1.2,48), new THREE.ShadowMaterial({opacity:0.35})); ground.rotation.x=-Math.PI/2; ground.position.y=-0.055; ground.receiveShadow=true; scene.add(ground);
  const deck=new THREE.Group(); scene.add(deck);
  const CASE_DIM={vintage:{w:0.34,d:0.24},sleek:{w:0.32,d:0.22},tactical:{w:0.34,d:0.24},hidden:{w:0.32,d:0.22},exposed:{w:0.32,d:0.22},luggable:{w:0.36,d:0.26}};
  const CASE_MAT={vintage:{c:0xe8dcc0,m:0,r:0.85},sleek:{c:0x2b3440,m:0.9,r:0.35},tactical:{c:0x5a6b3f,m:0.2,r:0.7},hidden:{c:0x7a4a2b,m:0,r:0.9},exposed:{c:0x3a3f45,m:0.7,r:0.45},luggable:{c:0x8a8f94,m:0.6,r:0.5}};
  const DISP={'4':{w:0.089,h:0.050},'7':{w:0.155,h:0.087},'10':{w:0.221,h:0.124},'13':{w:0.288,h:0.162}};
  const CAPC={low:0x2a2f33,chunky:0x1a1d20,vintage:0xe8dcc0,blank:0x222222};
  let exploded=0, firstFit=true, glbMode=false, glbGroup=null;
  const gltfLoader=new GLTFLoader();
  function loadDeckGLB(url,label){
    glbMode=true; disposeGroup(deck); deck.clear(); glbGroup=new THREE.Group(); deck.add(glbGroup);
    const backBtn=document.getElementById('viewMyBuild'); if(backBtn) backBtn.style.display='';
    if(statusEl) statusEl.textContent='Loading 3D model: '+label+'…';
    gltfLoader.load(url,(gltf)=>{
      glbGroup.add(gltf.scene);
      gltf.scene.traverse(o=>{if(o.isMesh){o.castShadow=true;o.receiveShadow=true;}});
      const bb=new THREE.Box3().setFromObject(glbGroup); const c=bb.getCenter(new THREE.Vector3());
      glbGroup.position.set(-c.x,-c.y,-c.z);
      controls.autoRotate=true; const rb=document.getElementById('viewRotate'); if(rb){rb.classList.add('on'); rb.textContent='Auto-rotate: on';}
      fitCamera();
      if(statusEl) statusEl.textContent='Viewing GLB: '+label+' — drag to orbit, it keeps auto-rotating. Click “Back to my build” to return to your configurator deck.';
    },undefined,()=>{
      glbMode=false; if(backBtn) backBtn.style.display='none';
      if(statusEl) statusEl.textContent='Could not load that GLB — showing your build instead.';
      if(window.__lastState) buildDeck(window.__lastState);
    });
  }
  window.loadDeckGLB=loadDeckGLB;
  function mat(c,m,r,extra={}){return new THREE.MeshStandardMaterial({color:c,metalness:m,roughness:r,...extra});}
  function rbox(w,h,d,c,m,r){const mesh=new THREE.Mesh(new RoundedBoxGeometry(w,h,d,2,Math.min(0.006,Math.min(w,h,d)/2)),mat(c,m,r));mesh.castShadow=true;mesh.receiveShadow=true;return mesh;}
  function box(w,h,d,c,m,r){const mesh=new THREE.Mesh(new THREE.BoxGeometry(w,h,d),mat(c,m,r));mesh.castShadow=true;mesh.receiveShadow=true;return mesh;}
  function screenTexture(title,displayId){
    const cv=document.createElement('canvas'); cv.width=512; cv.height=320; const g=cv.getContext('2d');
    g.fillStyle='#07130c'; g.fillRect(0,0,512,320); g.fillStyle='#39ff9a'; g.font='bold 28px monospace'; g.fillText(title,24,44);
    g.font='16px monospace'; g.fillStyle='#5eead4';
    ['> south-bay deck online','> battery 87%  ·  wifi ▂▄▆','> radio: LoRa mesh ready','> cpu 34%  ·  mem 2.1 / 8 GB'].forEach((t,i)=>g.fillText(t,24,84+i*28));
    g.fillStyle='#1e3a2a'; g.fillRect(24,210,464,18); g.fillStyle='#39ff9a'; g.fillRect(24,210,320,18);
    g.fillStyle='#9fb3a6'; g.font='13px monospace'; g.fillText('SOUTH BAY CYBER DECKS — YOU DESIGN IT',24,260);
    const tx=new THREE.CanvasTexture(cv); tx.colorSpace=THREE.SRGBColorSpace; return tx;
  }
  function lcdTexture(){
    const cv=document.createElement('canvas'); cv.width=256; cv.height=128; const g=cv.getContext('2d');
    g.fillStyle='#07130c'; g.fillRect(0,0,256,128); g.fillStyle='#39ff9a'; g.font='bold 20px monospace'; g.fillText('BAT 87%',16,32); g.fillText('WIFI ▂▄▆',16,64); g.fillText('CPU 34%',16,96);
    const tx=new THREE.CanvasTexture(cv); tx.colorSpace=THREE.SRGBColorSpace; return tx;
  }
  function solarTexture(){
    const cv=document.createElement('canvas'); cv.width=256; cv.height=176; const g=cv.getContext('2d');
    g.fillStyle='#0b2447'; g.fillRect(0,0,256,176); g.strokeStyle='#3a6ea5'; g.lineWidth=2;
    for(let x=0;x<=256;x+=32){g.beginPath();g.moveTo(x,0);g.lineTo(x,176);g.stroke();}
    for(let y=0;y<=176;y+=44){g.beginPath();g.moveTo(0,y);g.lineTo(256,y);g.stroke();}
    const tx=new THREE.CanvasTexture(cv); tx.colorSpace=THREE.SRGBColorSpace; return tx;
  }
  function disposeGroup(gr){gr.traverse(o=>{if(o.geometry)o.geometry.dispose();if(o.material){const ms=Array.isArray(o.material)?o.material:[o.material];ms.forEach(m=>{if(m.map)m.map.dispose();m.dispose();});}});}
  function buildDeck(s){
    glbGroup=null; disposeGroup(deck); deck.clear();
    const dim=CASE_DIM[s.case]||CASE_DIM.sleek, cm=CASE_MAT[s.case]||CASE_MAT.sleek;
    let caseColor=cm.c, caseMetal=cm.m, caseRough=cm.r;
    if(s.finish==='matte'){caseColor=0x1c1e20; caseMetal=0.3; caseRough=0.85;}
    let W=dim.w, D=dim.d; const baseY=0;
    if(s.display==='4'){const _b=DATA.boards.find(b=>b.id===s.board)||DATA.boards[2]; const _kw=Math.max(..._b.rows)*0.019+0.012, _kd=_b.rows.length*0.019+0.012; W=Math.max(_kw+0.04,0.089+0.05,0.20); D=Math.max(_kd+0.08,0.18);}
    const baseG=new THREE.Group(), screenG=new THREE.Group(), kbG=new THREE.Group(), accG=new THREE.Group();
    deck.add(baseG,screenG,kbG,accG);
    const base=rbox(W,0.035,D,caseColor,caseMetal,caseRough); base.position.y=baseY; baseG.add(base);
    if(s.case==='tactical'){
      [[-1,-1],[1,-1],[-1,1],[1,1]].forEach(([sx,sz])=>{const c=box(0.03,0.045,0.03,0x222222,0.1,0.8);c.position.set(sx*(W/2-0.008),0,sz*(D/2-0.008));baseG.add(c);});
      const h=box(0.12,0.012,0.02,0x222222,0.1,0.8); h.position.set(0,0.045,D/2+0.005); baseG.add(h);
    }
    if(s.case==='hidden'){
      const cover=box(W,0.008,D,0x5a3520,0,0.9); cover.position.y=-0.02; baseG.add(cover);
      const pages=box(0.012,0.03,D-0.01,0xf2ead6,0,0.9); pages.position.set(W/2-0.004,0,0); baseG.add(pages);
    }
    if(s.case==='exposed'){
      const pcb=box(W-0.06,0.006,D-0.06,0x0d5c2e,0.1,0.6); pcb.position.y=0.021; baseG.add(pcb);
      [[-1,-1],[1,-1],[-1,1],[1,1]].forEach(([sx,sz])=>{const st=new THREE.Mesh(new THREE.CylinderGeometry(0.006,0.006,0.03,20),mat(0xc98f2e,0.9,0.3));st.position.set(sx*(W/2-0.015),0.028,sz*(D/2-0.015));st.castShadow=true;baseG.add(st);});
    }
    if(s.case==='luggable'){
      const h=box(0.14,0.014,0.02,0x222222,0.2,0.7); h.position.set(0,0.04,D/2+0.005); baseG.add(h);
      [-1,1].forEach(sx=>{const l=box(0.03,0.015,0.01,0xc0c0c0,0.9,0.3);l.position.set(sx*0.08,0.005,D/2+0.002);baseG.add(l);});
    }
    if(s.case==='vintage'){const badge=box(0.06,0.004,0.014,0xc98f2e,0.9,0.3);badge.position.set(0,0.02,D/2-0.01);baseG.add(badge);}
    // Screen
    const disp=DISP[s.display];
    if(disp){
      screenG.position.set(0,0.02,-D/2); screenG.rotation.x=-0.26;
      if(s.form==='slab'){screenG.position.z-=0.08; screenG.rotation.x=-0.15;}
      if(s.form==='luggable') screenG.rotation.x=-0.35;
      if(s.form==='typewriter') screenG.rotation.x=-0.35;
      const bez=rbox(disp.w+0.016,disp.h+0.016,0.012,0x111111,0.4,0.4); bez.position.y=(disp.h+0.016)/2; screenG.add(bez);
      const scr=new THREE.Mesh(new THREE.BoxGeometry(disp.w,disp.h,0.002), new THREE.MeshBasicMaterial({map:screenTexture('SOUTH BAY // DECK',s.display)}));
      scr.position.set(0,(disp.h+0.016)/2,0.007); screenG.add(scr);
      if(s.form==='book'){const cov=box(disp.w+0.04,disp.h+0.04,0.004,0x7a4a2b,0,0.9);cov.position.set(0,(disp.h+0.02)/2,-0.008);screenG.add(cov);}
    }
    // Keyboard
    const board=DATA.boards.find(b=>b.id===s.board)||DATA.boards[2]; const pitch=0.019;
    const cols=Math.max(...board.rows), kw=cols*pitch+0.012, kd=board.rows.length*pitch+0.012;
    const kbY=0.024, kbZ=0.015;
    const pcb=box(kw,0.006,kd,0x0f1a12,0.1,0.6); pcb.position.set(0,kbY,kbZ);
    if(s.board!=='SB-Split36') kbG.add(pcb);
    if(s.board==='SB-Split36'){
      const pcbL=box(kw/2-0.008,0.006,kd,0x0f1a12,0.1,0.6); pcbL.position.set(-kw/4-0.008,kbY,kbZ); kbG.add(pcbL);
      const pcbR=box(kw/2-0.008,0.006,kd,0x0f1a12,0.1,0.6); pcbR.position.set(kw/4+0.008,kbY,kbZ); kbG.add(pcbR);
    }
    const capC=CAPC[s.keycaps]||CAPC.chunky;
    board.rows.forEach((n,ri)=>{
      const z=kbZ+(ri-board.rows.length/2+0.5)*pitch;
      const addKey=(x,isSpace)=>{
        let k;
        if(s.keycaps==='vintage'){k=new THREE.Mesh(new THREE.CylinderGeometry(0.0085,0.0085,0.01,20),mat(capC,0,0.7));}
        else if(isSpace){k=rbox(pitch*3.2,0.01,pitch*0.88,capC,0.1,0.6);}
        else{k=rbox(0.017,0.01,0.017,capC,0.1,0.6);}
        k.position.set(x,kbY+0.008,z); k.castShadow=true; kbG.add(k);
      };
      if(s.board==='SB-Split36'){
        const half=Math.ceil(n/2);
        for(let i=0;i<half;i++) addKey(-kw/4-0.008+(i-(half-1)/2)*pitch,false);
        for(let i=0;i<n-half;i++) addKey(kw/4+0.008+(i-(n-half-1)/2)*pitch,false);
      } else {
        for(let i=0;i<n;i++){const isSpace=(ri===board.rows.length-1&&i===Math.floor(n/2)); addKey((i-(n-1)/2)*pitch,isSpace);}
      }
    });
    if(s.form==='typewriter') kbG.rotation.x=-0.10;
    if(s.form==='slab') kbG.position.z+=0.03;
    // Pointer
    const tpY=kbY+0.006;
    if(s.touchpad==='side'){const p=rbox(0.055,0.004,0.04,0x1c2b22,0.2,0.4);p.position.set(kw/2+0.035,tpY,kbZ);kbG.add(p);}
    if(s.touchpad==='center'){const p=rbox(0.055,0.004,0.04,0x1c2b22,0.2,0.4);p.position.set(0,tpY,kbZ+kd/2+0.03);kbG.add(p);}
    if(s.touchpad==='trackball'){const b=new THREE.Mesh(new THREE.SphereGeometry(0.017,28,20),mat(0x5eead4,0.3,0.3));b.position.set(kw/2+0.035,tpY+0.008,kbZ);b.castShadow=true;kbG.add(b);}
    if(s.touchpad==='stick'){const st=new THREE.Mesh(new THREE.CylinderGeometry(0.004,0.004,0.012,16),mat(0x222222,0.2,0.6));st.position.set(0,tpY+0.006,kbZ);kbG.add(st);}
    // Accessories
    const topY=0.022, bx=W/2-0.03, bz=-D/2+0.03;
    const acc=s.accessories||[];
    if(acc.includes('esp32lcd')){const m=box(0.07,0.02,0.045,0x222222,0.3,0.5);m.position.set(bx-0.05,topY+0.01,bz);accG.add(m);const lcd=new THREE.Mesh(new THREE.BoxGeometry(0.055,0.002,0.032),new THREE.MeshBasicMaterial({map:lcdTexture()}));lcd.position.set(bx-0.05,topY+0.021,bz);accG.add(lcd);}
    if(acc.includes('esp32second')){const m=box(0.055,0.014,0.035,0x1a3a2a,0.2,0.5);m.position.set(bx-0.13,topY+0.007,bz);accG.add(m);}
    const antenna=(x,h)=>{const a=new THREE.Mesh(new THREE.CylinderGeometry(0.003,0.003,h,12),mat(0x222222,0.3,0.5));a.position.set(x,topY+h/2,bz);a.rotation.z=0.08;a.castShadow=true;accG.add(a);const tip=new THREE.Mesh(new THREE.SphereGeometry(0.005,14,10),mat(0x39ff9a,0.2,0.4));tip.position.set(x+0.08*h,topY+h,bz);accG.add(tip);};
    if(acc.includes('lora')) antenna(-bx,0.14);
    if(acc.includes('wifi')) antenna(-bx+0.04,0.10);
    if(acc.includes('gps')){const g=new THREE.Mesh(new THREE.CylinderGeometry(0.02,0.02,0.012,24),mat(0x333333,0.4,0.5));g.position.set(bx,topY+0.006,D/2-0.03);g.castShadow=true;accG.add(g);}
    if(acc.includes('sdr')){const m=box(0.05,0.014,0.022,0x3355aa,0.3,0.5);m.position.set(-bx,topY+0.007,D/2-0.03);accG.add(m);}
    if(acc.includes('seconddisplay')){const bz2=rbox(0.10,0.07,0.008,0x111111,0.4,0.4);bz2.position.set(bx,topY+0.045,0);accG.add(bz2);const sc=new THREE.Mesh(new THREE.BoxGeometry(0.09,0.06,0.002),new THREE.MeshBasicMaterial({map:screenTexture('STATUS') }));sc.position.set(bx,topY+0.045,0.005);accG.add(sc);}
    if(acc.includes('solar')){const p=new THREE.Mesh(new THREE.BoxGeometry(0.16,0.004,0.11),new THREE.MeshStandardMaterial({map:solarTexture(),metalness:0.6,roughness:0.25}));p.position.set(0,0.20,-D/2-0.07);p.rotation.x=-0.5;p.castShadow=true;accG.add(p);}
    if(acc.includes('engrave')){const p=box(0.08,0.002,0.018,0xc98f2e,0.9,0.3);p.position.set(0,topY,D/2-0.015);accG.add(p);}
    // Exploded offsets
    baseG.position.y=0; kbG.position.y=exploded*0.07; screenG.position.y+=exploded*0.14; accG.position.y=exploded*0.03;
    if(firstFit){fitCamera(); firstFit=false;}
    if(statusEl) statusEl.textContent='3D ready — drag to orbit, scroll to zoom.';
  }
  function fitCamera(){
    const bb=new THREE.Box3().setFromObject(deck); if(bb.isEmpty()) return;
    const c=bb.getCenter(new THREE.Vector3()), s=bb.getSize(new THREE.Vector3()); const maxDim=Math.max(s.x,s.y,s.z);
    controls.target.copy(c); camera.position.set(c.x+maxDim*1.1,c.y+maxDim*0.9,c.z+maxDim*1.25); camera.lookAt(c);
  }
  function resize(){const w=canvas.clientWidth||340, h=canvas.clientHeight||300; renderer.setSize(w,h,false); camera.aspect=w/h; camera.updateProjectionMatrix();}
  new ResizeObserver(resize).observe(canvas); resize();
  window.updateDeck3D=(s)=>buildDeck(s);
  document.getElementById('viewReset')?.addEventListener('click',fitCamera);
  const rotBtn=document.getElementById('viewRotate');
  rotBtn?.addEventListener('click',()=>{controls.autoRotate=!controls.autoRotate; rotBtn.classList.toggle('on',controls.autoRotate); rotBtn.textContent='Auto-rotate: '+(controls.autoRotate?'on':'off');});
  document.getElementById('viewExploded')?.addEventListener('click',(e)=>{exploded=exploded?0:1; e.currentTarget.classList.toggle('on',!!exploded); if(window.__lastState) buildDeck(window.__lastState);});
  document.getElementById('viewTop')?.addEventListener('click',()=>{const bb=new THREE.Box3().setFromObject(deck);const c=bb.getCenter(new THREE.Vector3());controls.target.copy(c);camera.position.set(c.x,c.y+1.0,c.z+0.01);});
  // Keep last state for exploded rebuilds: wrap updateDeck3D
  const orig=window.updateDeck3D; window.updateDeck3D=(s)=>{window.__lastState=s; if(glbMode){glbMode=false; const b=document.getElementById('viewMyBuild'); if(b) b.style.display='none';} orig(s);};
  document.getElementById('viewMyBuild')?.addEventListener('click',()=>{glbMode=false; document.getElementById('viewMyBuild').style.display='none'; if(window.__lastState) buildDeck(window.__lastState);});
  (function loop(){requestAnimationFrame(loop); controls.update(); renderer.render(scene,camera);})();
  if(typeof update==='function') update();
} else if(statusEl){statusEl.textContent='3D canvas not found.';}
</script>
</body>
</html>
