<!doctype html>
<html lang="zh-Hant">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>天堂M Core Rebuild V28</title>
<style>
:root{--bg:#05070a;--panel:#101827;--panel2:#172235;--line:#334155;--text:#e5eef9;--muted:#94a3b8;--gold:#facc15;--green:#22c55e;--red:#ef4444;--blue:#60a5fa;--purple:#c084fc;--orange:#fb923c;--cyan:#22d3ee}*{box-sizing:border-box}body{margin:0;background:radial-gradient(circle at 15% 0,#182943 0,#05070a 45%,#02040a 100%);color:var(--text);font-family:"Microsoft JhengHei",system-ui,sans-serif;font-size:14px;user-select:none}.hide{display:none!important}button,input,select{font:inherit;color:var(--text);background:#1d293b;border:1px solid #475569;border-radius:9px;padding:7px 10px}button{cursor:pointer}button:hover{background:#30435f}button:disabled{opacity:.45}.app{height:100vh;display:flex;flex-direction:column;gap:10px;padding:10px}.panel{background:linear-gradient(180deg,rgba(20,31,49,.96),rgba(8,13,23,.96));border:1px solid var(--line);border-radius:14px;padding:12px;box-shadow:0 8px 22px rgba(0,0,0,.28)}.top,.row{display:flex;align-items:center;justify-content:space-between;gap:8px}.main{flex:1;min-height:0;display:grid;grid-template-columns:330px 1fr 380px;gap:10px}.col{display:flex;flex-direction:column;gap:10px;min-height:0}.scroll{overflow:auto}.title{font-weight:800;color:var(--gold)}.muted{color:var(--muted);font-size:13px}.gold{color:var(--gold)}.green{color:#86efac}.red{color:#fca5a5}.blue{color:#93c5fd}.purple{color:var(--purple)}.orange{color:var(--orange)}.cyan{color:var(--cyan)}.grid{display:grid;gap:10px}.cards{grid-template-columns:repeat(auto-fit,minmax(220px,1fr))}.stats{grid-template-columns:repeat(2,1fr);gap:6px}.card,.stat{background:#0a1221;border:1px solid #26364e;border-radius:12px;padding:10px}.bar{height:19px;background:#030814;border:1px solid #41516a;border-radius:99px;overflow:hidden;position:relative}.bar i{display:block;height:100%;width:0;transition:width .2s}.bar span{position:absolute;inset:0;text-align:center;line-height:17px;font-size:12px;text-shadow:1px 1px 2px #000;z-index:2;pointer-events:none}.bar i{position:relative;z-index:1}.hp{background:linear-gradient(90deg,#7f1d1d,#ef4444)}.mp{background:linear-gradient(90deg,#1e3a8a,#60a5fa)}.exp{background:linear-gradient(90deg,#854d0e,#facc15)}.leaf{background:linear-gradient(90deg,#065f46,#34d399)}.tabs{display:flex;gap:6px;flex-wrap:wrap}.tab.on{border-color:var(--gold);color:var(--gold);background:#2b2512}.item{border-bottom:1px dashed #334155;padding:8px 0}.pill{display:inline-block;border:1px solid #475569;border-radius:99px;background:#0d1728;padding:3px 8px;margin:2px;font-size:12px}.modal{position:fixed;inset:0;background:rgba(0,0,0,.86);z-index:9;display:flex;align-items:center;justify-content:center;padding:14px}.modal-card{width:min(980px,96vw);max-height:92vh;overflow:auto}.classes{grid-template-columns:repeat(auto-fit,minmax(170px,1fr))}.class-card{text-align:left;min-height:115px}.class-card.on{border-color:var(--gold);background:#24314a}.r-N{color:#e5e7eb}.r-R{color:#4ade80}.r-SR{color:#60a5fa}.r-SSR{color:#c084fc}.r-L{color:#fb923c}.r-M{color:#f87171}.split{display:grid;grid-template-columns:1fr auto;gap:8px;align-items:center}.log{font-size:13px;line-height:1.55}.mini{font-size:12px}.big{font-size:30px}@media(max-width:1180px){.app{height:auto}.main{grid-template-columns:1fr}.col{min-height:420px}.top{flex-direction:column;align-items:flex-start}}
</style>
</head><body>
<div id="start" class="modal"><div class="panel modal-card"><h1 class="title" style="font-size:40px;text-align:center">天堂M Core Rebuild</h1><p class="muted" style="text-align:center">單機HTML｜離線存檔｜核心整合版：職業、地圖、怪物、掉落鑽石、裝備、強化、變身、娃娃、技能、技能書、副本、Boss、血盟、收藏、製作、商城、PVP、交易所、完整度檢查。</p><div class="grid"><button id="newBtn" class="green" style="font-size:22px;padding:14px">新冒險</button><button id="loadBtn" class="blue" style="font-size:22px;padding:14px">讀取存檔</button><button id="importBtn">匯入 JSON 存檔</button><input id="importFile" type="file" accept=".json,application/json" class="hide"></div></div></div>
<div id="classModal" class="modal hide"><div class="panel modal-card"><h2 class="title">選擇職業</h2><div id="classList" class="grid classes"></div><div class="row" style="margin-top:12px"><button id="backBtn">返回</button><button id="startBtn" class="green" disabled>開始遊戲</button></div></div></div>
<div id="app" class="app hide"><div class="panel top"><div><span class="title" style="font-size:22px">天堂M Core Rebuild｜核心整合版</span> <span id="subtitle" class="muted"></span></div><div class="row"><button id="saveBtn" class="blue">儲存</button><button id="exportBtn">匯出</button><button id="resetBtn" class="red">刪除</button></div></div><div class="main"><div class="col"><div class="panel"><div class="row"><b class="title">角色資訊</b><span id="className" class="gold"></span></div><div class="row"><span>Lv.<b id="lv">1</b></span><span>金幣 <b id="adena" class="gold">0</b></span><span>鑽石 <b id="diamond" class="cyan">0</b></span></div><div>HP<div class="bar"><i id="hpBar" class="hp"></i><span id="hpTxt"></span></div></div><div>MP<div class="bar"><i id="mpBar" class="mp"></i><span id="mpTxt"></span></div></div><div>EXP<div class="bar"><i id="expBar" class="exp"></i><span id="expTxt"></span></div></div><div>殷海薩葉子<div class="bar"><i id="leafBar" class="leaf"></i><span id="leafTxt"></span></div></div><div id="statBox" class="grid stats" style="margin-top:10px"></div></div><div class="panel scroll" style="flex:1"><b class="title">系統紀錄</b><div id="sysLog" class="log"></div></div></div><div class="col"><div class="panel"><div id="tabs" class="tabs"></div></div><div class="panel scroll" style="flex:1"><div id="content"></div></div></div><div class="col"><div class="panel"><div class="row"><b class="title">狩獵地圖</b><select id="mapSelect"></select></div><div id="mapInfo" class="muted"></div></div><div class="panel"><b class="title">目前目標</b><div id="monsterName" class="red" style="font-size:22px;margin:8px 0">尋找中</div><div class="bar"><i id="monBar" class="hp"></i><span id="monTxt"></span></div></div><div class="panel scroll" style="flex:1"><b class="title">戰鬥紀錄</b><div id="battleLog" class="log"></div></div></div></div></div>
<script>
'use strict';
const R={N:['一般',1],R:['高級',2],SR:['稀有',3],SSR:['英雄',4],L:['傳說',5],M:['神話',6]};
const E=s=>String(s??'').replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
const DB={classes:{},item:{},cards:{},maps:[],dungeons:[],bosses:[],codex:[],skills:{}};
function addClass(id,name,stats,weapons,desc){DB.classes[id]={id,name,stats,weapons,desc};}
[['prince','王族',{str:13,dex:10,con:12,int:10,wis:11},['sword','dagger'],'血盟與輔助'],['knight','騎士',{str:16,dex:12,con:15,int:8,wis:9},['sword','twohand','spear'],'高防禦近戰'],['elf','妖精',{str:11,dex:16,con:12,int:12,wis:13},['bow','dagger','sword'],'遠程與精靈魔法'],['wizard','法師',{str:8,dex:10,con:10,int:18,wis:17},['staff','dagger'],'魔法與治癒'],['darkelf','黑暗妖精',{str:14,dex:16,con:12,int:11,wis:10},['dualblade','claw','dagger'],'爆擊雙刀'],['dragon','龍鬥士',{str:16,dex:12,con:15,int:10,wis:10},['chain_sword'],'龍之力'],['illusion','幻術士',{str:10,dex:11,con:12,int:16,wis:15},['kiringku','staff'],'精神輔助'],['warrior','戰士',{str:17,dex:11,con:17,int:8,wis:9},['axe','twohand'],'高血雙斧'],['fencer','劍士',{str:15,dex:15,con:13,int:10,wis:10},['sword','dagger'],'連擊'],['lancer','神聖劍士',{str:16,dex:13,con:15,int:9,wis:11},['spear','sword'],'槍術聖力'],['reaper','死神',{str:15,dex:14,con:14,int:12,wis:11},['scythe','sword'],'鐮刀與靈魂'],['thunder','雷神',{str:14,dex:15,con:13,int:13,wis:12},['spear','staff'],'雷電範圍'],['darkknight','黑暗騎士',{str:17,dex:12,con:16,int:9,wis:10},['sword','twohand'],'黑暗防禦']].forEach(x=>addClass(...x));
function addItem(id,o){DB.item[id]=Object.assign({id,type:'material',rank:'N',price:100},o);}
const weapons=[['short_sword','短劍','dagger',5,'N'],['katana','武士刀','sword',17,'R'],['mailbreaker','破壞之劍','sword',24,'SR'],['death_blade','死亡騎士烈炎劍','sword',36,'SSR'],['dragon_slayer','真・屠龍劍','twohand',54,'L'],['mythic_excalibur','神話王者之劍','sword',82,'M'],['crossbow','十字弓','bow',16,'R'],['saiha_bow','沙哈之弓','bow',35,'SSR'],['gaia_bow','蓋亞激怒','bow',55,'L'],['zero_staff','零式魔杖','staff',48,'L'],['ice_staff','冰之女王魔杖','staff',58,'L'],['roaring_dual','咆哮雙刀','dualblade',43,'L'],['blood_claw','血光鋼爪','claw',42,'L'],['chain_sword','殲滅者鎖鏈劍','chain_sword',30,'SSR'],['mortal_chain','破滅鎖鏈劍','chain_sword',44,'L'],['titan_axe','泰坦戰斧','axe',40,'L'],['holy_spear','神聖長槍','spear',37,'SSR'],['thunder_spear','雷神長槍','spear',47,'L'],['soul_scythe','靈魂鐮刀','scythe',42,'L'],['kiringku','奇古獸','kiringku',36,'SSR'],['valakas_sword','巴拉卡斯烈焰劍','sword',72,'M'],['lindvior_bow','林德拜爾風暴弓','bow',74,'M'],['fafu_staff','法利昂水晶魔杖','staff',70,'M']];
weapons.forEach((x,i)=>addItem(x[0],{name:x[1],type:'weapon',weapon:x[2],dmg:x[3],rank:x[4],safe:6,price:1200*(i+1)*R[x[4]][1]}));
[['tshirt','T恤','tshirt',0,'N',{}],['iron_helm','鋼盔','helmet',-2,'R',{}],['iron_armor','鋼鐵盔甲','armor',-7,'R',{}],['magic_cloak','抗魔斗篷','cloak',-3,'SR',{mr:10}],['power_gloves','力量手套','gloves',-1,'SR',{str:2}],['dex_boots','敏捷長靴','boots',-3,'SR',{dex:2}],['ancient_armor','古代盔甲','armor',-13,'SSR',{hp:200}],['dragon_armor','龍之盔甲','armor',-20,'L',{dr:8,mr:20}],['valakas_armor','巴拉卡斯盔甲','armor',-24,'L',{dmg:10,hp:200}],['mythic_armor','神話守護甲','armor',-32,'M',{dr:16,hp:700,mr:40}]].forEach((x,i)=>addItem(x[0],{name:x[1],type:x[2],ac:x[3],rank:x[4],stat:x[5],safe:4,price:900*(i+1)*R[x[4]][1]}));
[['brave_necklace','勇氣項鍊','amulet',{dmg:3},'SR'],['wisdom_ring','智慧戒指','ring',{int:2,wis:1},'SR'],['def_ring','守護戒指','ring',{ac:-2,dr:2},'SR'],['dark_earring','黑暗耳環','earring',{dmg:5,hit:2},'SSR'],['ogre_belt','歐吉皮帶','belt',{hp:180,str:1},'SSR'],['dragon_ring','龍之戒指','ring',{dmg:8,hit:5,ac:-4},'L'],['mythic_earring','神話耳環','earring',{str:3,dex:3,int:3,wis:3,dmg:10},'M'],['rune_guard','守護符石','rune',{dr:4,hp:120},'SSR'],['seal_hero','英雄印章','seal',{dmg:6,hit:4},'SSR'],['relic_dragon','龍之聖物','relic',{dmg:10,dr:8,mr:20},'L']].forEach((x,i)=>addItem(x[0],{name:x[1],type:x[2],stat:x[3],rank:x[4],safe:0,price:2500*(i+1)*R[x[4]][1]}));
[['potion_red','紅水',45,90],['potion_orange','橙水',210,260],['potion_clear','白水',650,680],['leaf_box','葉子補充箱',5000,0]].forEach(x=>addItem(x[0],{name:x[1],type:x[0]=='leaf_box'?'box':'potion',price:x[2],heal:x[3]}));
[['scroll_weapon','武卷','weapon',75000],['scroll_armor','防卷','armor',30000],['scroll_bless_weapon','祝武','weapon',260000],['scroll_bless_armor','祝防','armor',120000],['scroll_accessory','飾品卷','accessory',90000]].forEach(x=>addItem(x[0],{name:x[1],type:'scroll',target:x[2],price:x[3],rank:x[0].includes('bless')?'R':'N'}));
['哈爾巴斯結晶','龍之鑽石碎片','名譽幣','變身製作硬幣','娃娃製作硬幣','祝福粉末','紋樣石','聖物碎片','熟練書','龍之鱗'].forEach((n,i)=>addItem('mat'+i,{name:n,type:'material',price:500+i*300,rank:i>5?'SR':'R'}));
function card(id,name,rank,stat,kind){DB.cards[id]={id,name,rank,stat,kind};}
[['t_orc','妖魔','N',{spd:3},'transform'],['t_skel','骷髏','R',{dex:1,spd:5},'transform'],['t_succ','魅魔','SR',{int:2,mp:80,spd:8},'transform'],['t_dk','死亡騎士','SSR',{str:3,dmg:8,hit:5,spd:18},'transform'],['t_ken','反王肯恩','L',{str:5,dex:3,dmg:16,hit:10,dr:6,spd:25},'transform'],['t_odin','神話奧丁','M',{str:8,dex:8,int:6,wis:6,dmg:30,hit:20,dr:14,spd:35},'transform'],['d_bug','肥肥','N',{hp:30},'doll'],['d_spartoi','史巴托','R',{dmg:1,mp:30},'doll'],['d_succ','魅魔娃娃','SR',{mp:120,int:2},'doll'],['d_dk','死亡騎士娃娃','SSR',{dmg:8,hit:4},'doll'],['d_lich','巫妖娃娃','L',{int:6,wis:5,dmg:10,mr:20},'doll'],['d_dragon','神話龍娃娃','M',{str:6,dex:6,int:6,dmg:22,dr:12,hp:600},'doll']].forEach(x=>card(...x));
DB.maps=[['talking','說話之島',1,18,['哥布林','妖魔','狼人'],['short_sword','tshirt','potion_red','mat0']],['gludin','古魯丁地監',18,38,['骷髏','殭屍','食屍鬼'],['katana','iron_helm','iron_armor','scroll_armor']],['giran','奇岩地監',35,55,['囚犯','黑暗守衛','巴風特信徒'],['mailbreaker','power_gloves','magic_cloak','scroll_weapon']],['dragon','龍之谷',50,72,['哈維','飛龍','骨龍','飛龍王'],['saiha_bow','dragon_ring','scroll_bless_weapon','mat1']],['toi','傲慢之塔',65,88,['傲慢殭屍','死亡騎士親衛','木乃伊王'],['death_blade','ancient_armor','dark_earring','mat2']],['lastabad','拉斯塔巴德',80,95,['黑妖將軍','黑妖法師','親衛隊'],['roaring_dual','chain_sword','ogre_belt','mat3']],['antharas','安塔瑞斯巢穴',88,99,['地龍守衛','安塔瑞斯'],['dragon_slayer','dragon_armor','relic_dragon','mat7']],['valakas','巴拉卡斯熔岩區',90,99,['火龍守衛','巴拉卡斯'],['mythic_excalibur','mythic_armor','mythic_earring','mat7']]].map(x=>({id:x[0],name:x[1],min:x[2],max:x[3],mons:x[4],drops:x[5]}));
DB.dungeons=['試煉副本','夢幻之島','拋棄之地','傲慢之塔副本','海音地監','龍之鑽石副本','血盟副本','世界副本','四龍副本','跨服競技場'].map((n,i)=>({id:'dg'+i,name:n,lv:10+i*8,cost:i<3?0:100,reward:5000+i*2000}));
DB.bosses=['巨大飛龍','巴風特','死亡騎士','巫妖','木乃伊王','安塔瑞斯','法利昂','巴拉卡斯','林德拜爾','吉爾塔斯'].map((n,i)=>({id:'b'+i,name:n,lv:30+i*7,hp:1500+i*900}));
DB.codex=[['武器收藏I',['katana','mailbreaker'],{dmg:2}],['龍裝收藏',['dragon_slayer','dragon_armor','dragon_ring'],{dmg:10,dr:6}],['神話收藏',['mythic_excalibur','mythic_armor','mythic_earring'],{dmg:20,hp:500}],['變身收藏',['t_dk','t_ken'],{hit:5,dmg:5}],['娃娃收藏',['d_dk','d_lich'],{dr:5,mr:10}]];
const skillNames={prince:['精準目標','王族威嚴','激勵士氣','君主之怒','血盟守護','王者命令','突襲指揮','戰場號令','君主反擊','榮耀之劍','王者降臨','君主覺醒'],knight:['衝擊之暈','堅固防護','反擊屏障','精準打擊','騎士精神','鋼鐵意志','盾牌衝擊','勇猛意志','重甲熟練','致命突刺','神聖防禦','騎士覺醒'],elf:['三重矢','風之疾走','精靈祝福','烈焰箭','水之治癒','大地防護','暴風神射','魂體轉換','精靈命中','月光箭雨','元素守護','精靈覺醒'],wizard:['冰錐','高級治癒術','魔力增幅','火球術','聖結界','冥想','流星雨','究極光裂術','魔法命中','寒冰屏障','神聖恢復','法師覺醒'],darkelf:['雙重破壞','暗影閃避','燃燒鬥志','毒性衝擊','暗黑盔甲','雙刀熟練','破壞盔甲','暗影之牙','會心強化','黑暗衝擊','暗殺之舞','黑妖覺醒'],dragon:['屠宰者','龍之護鎧','龍族血統','弱點曝光','岩漿噴吐','龍之意志','恐懼無助','覺醒安塔瑞斯','龍之命中','龍炎爆發','龍魂守護','龍鬥覺醒'],illusion:['立方燃燒','鏡像','幻覺分身','精神衝擊','專注','幻術屏障','恐慌','骷髏毀壞','精神熟練','心靈破壞','幻想守護','幻術覺醒'],warrior:['泰坦狂暴','戰士護體','雙斧熟練','粉碎衝擊','咆哮','泰坦之血','戰斧旋風','狂戰士意志','血量強化','巨人一擊','泰坦防禦','戰士覺醒'],fencer:['幻影劍','格擋','劍士熟練','連鎖劍擊','精準反擊','快速步伐','無限連擊','穿刺之劍','劍氣強化','終結刺擊','戰術防禦','劍士覺醒'],lancer:['聖槍突刺','聖光護體','長槍熟練','審判之槍','聖域','神聖意志','穿透長槍','聖潔屏障','神聖命中','聖槍風暴','聖盾加護','神聖覺醒'],reaper:['死亡鐮刀','靈魂護盾','靈魂熟練','奪魂斬','亡者氣息','收割意志','死神降臨','靈魂爆裂','黑暗命中','終焉收割','死神守護','死神覺醒'],thunder:['雷電衝擊','雷神護體','雷槍熟練','閃電鏈','風暴加速','雷電意志','雷霆一擊','天雷落下','雷神命中','暴雷領域','雷神守護','雷神覺醒'],darkknight:['黑暗斬擊','深淵護甲','血之契約','暗黑衝擊','毀滅覺醒','黑暗屏障','吸血斬','深淵凝視','暗黑反擊','血月之力','毀滅劍氣','黑暗騎士覺醒']};
const types=['active','buff','passive','active','buff','passive','active','buff','passive','active','buff','passive'], typeName={active:'主動攻擊',buff:'輔助/增益',passive:'被動'};
Object.keys(DB.classes).forEach(cls=>{(skillNames[cls]||[]).forEach((name,i)=>{let rank=['N','N','R','R','SR','SR','SSR','SSR','L','L','M','M'][i], lv=[1,4,8,12,20,28,38,48,60,70,82,90][i], type=types[i]; let id='sk_'+cls+'_'+String(i+1).padStart(2,'0'); let stat=type==='passive'?{dmg:1+Math.floor(i/3),hit:Math.floor(i/4),dr:i>5?1:0}:type==='buff'?{dmg:1+Math.floor(i/4),ac:i>3?-1:0,mr:i>5?2:0}:{dmg:2+Math.floor(i/2)}; DB.skills[id]={id,classId:cls,name,rank,lv,type,typeName:typeName[type],mp:type==='passive'?0:8+i*4,power:type==='active'?70+i*28:0,stat,desc:DB.classes[cls].name+'專屬'+typeName[type]+'技能。'}; addItem('book_'+id,{name:'技能書：'+name,type:'book',rank,price:50000+lv*4000,skill:id});});});
const Store={key:'lm_core_rebuild_v15',save:s=>localStorage.setItem('lm_core_rebuild_v15',JSON.stringify(s)),load:()=>{try{return JSON.parse(localStorage.getItem('lm_core_rebuild_v15')||localStorage.getItem('lm_all_in_one_v1')||'null')}catch{return null}},clear:()=>{localStorage.removeItem('lm_core_rebuild_v15');localStorage.removeItem('lm_all_in_one_v1')}};
const Game={s:null,timer:null,tab:'dash',pick:null,$:id=>document.getElementById(id),init(){this.bind();this.classList();this.$('loadBtn').disabled=!Store.load();},base(cls){return{version:'core_rebuild_v15',cls,lv:1,exp:0,adena:50000,diamond:3000,leaf:200,hp:1,mp:1,map:'talking',mon:null,stats:{...DB.classes[cls].stats},inv:{'potion_red|0':{id:'potion_red',qty:100,enchant:0},'scroll_weapon|0':{id:'scroll_weapon',qty:5,enchant:0},'scroll_armor|0':{id:'scroll_armor',qty:8,enchant:0}},equip:{weapon:null,helmet:null,tshirt:null,armor:null,cloak:null,gloves:null,boots:null,amulet:null,belt:null,earring1:null,earring2:null,ring1:null,ring2:null,rune:null,seal:null,relic:null},cards:{},active:{transform:null,doll:null},learnedSkills:{},skillLevels:{},skillAwake:{},settings:{hpLimit:45,autoPotion:true,autoBuy:true,autoBoss:true,autoSell:false,autoSkills:[]},guild:{name:'亞丁遠征軍',lv:1,donate:0,skill:0},daily:{dungeon:5,boss:3,tj:1,kills:0,diamondQuest:0},ach:{kills:0,boss:0,draw:0,craft:0,diamond:0,dailyDiamond:0},diamondLog:[],codex:{},growth:{mastery:0,magic:0,pvp:0},mail:[],last:Date.now()};},bind(){this.$('newBtn').onclick=()=>{this.$('start').classList.add('hide');this.$('classModal').classList.remove('hide')};this.$('backBtn').onclick=()=>{this.$('start').classList.remove('hide');this.$('classModal').classList.add('hide')};this.$('startBtn').onclick=()=>{this.s=this.base(this.pick);this.ensure();this.s.hp=this.maxHp();this.s.mp=this.maxMp();this.enter();this.log('開始冒險：'+this.cls().name)};this.$('loadBtn').onclick=()=>{this.s=Store.load();this.offline();this.enter();this.log('讀取存檔完成')};this.$('saveBtn').onclick=()=>this.save(true);this.$('exportBtn').onclick=()=>this.export();this.$('resetBtn').onclick=()=>{if(confirm('確定刪除存檔？')){Store.clear();location.reload()}};this.$('importBtn').onclick=()=>this.$('importFile').click();this.$('importFile').onchange=e=>this.import(e);this.$('mapSelect').onchange=e=>{this.s.map=e.target.value;this.s.mon=null;this.render()};this.$('content').addEventListener('click',e=>{let b=e.target.closest('[data-act]');if(b)this.action(b.dataset.act,b.dataset.arg,b)});this.$('content').addEventListener('change',e=>{let x=e.target;if(x.dataset.set){this.s.settings[x.dataset.set]=x.type==='checkbox'?x.checked:+x.value;this.save(false);this.render()}});},classList(){let box=this.$('classList');box.innerHTML=Object.values(DB.classes).map(c=>`<button class="class-card" data-id="${c.id}"><b class="gold">${c.name}</b><br><span class="muted">${c.desc}</span><br><span class="muted">STR ${c.stats.str} / DEX ${c.stats.dex} / INT ${c.stats.int}</span></button>`).join('');box.querySelectorAll('button').forEach(b=>b.onclick=()=>{this.pick=b.dataset.id;box.querySelectorAll('button').forEach(x=>x.classList.remove('on'));b.classList.add('on');this.$('startBtn').disabled=false})},enter(){this.ensure();this.$('start').classList.add('hide');this.$('classModal').classList.add('hide');this.$('app').classList.remove('hide');this.tabs();this.$('mapSelect').innerHTML=DB.maps.map(m=>`<option value="${m.id}">${m.name} Lv${m.min}-${m.max}</option>`).join('');clearInterval(this.timer);this.timer=setInterval(()=>this.tick(),1000);this.render();this.save(false)},ensure(){let s=this.s;if(!s)return;s.cls=s.cls&&DB.classes[s.cls]?s.cls:'knight';s.inv=s.inv||{};s.equip=s.equip||{};s.stats=s.stats||{...DB.classes[s.cls].stats};s.active=s.active||{transform:null,doll:null};s.cards=s.cards||{};s.codex=s.codex||{};s.guild=s.guild||{name:'亞丁遠征軍',lv:1,donate:0,skill:0};s.daily=Object.assign({dungeon:5,boss:3,tj:1,kills:0,diamondQuest:0},s.daily||{});s.ach=Object.assign({kills:0,boss:0,draw:0,craft:0,diamond:0,dailyDiamond:0},s.ach||{});s.growth=s.growth||s.skills||{mastery:0,magic:0,pvp:0};s.learnedSkills=s.learnedSkills||{};s.skillLevels=s.skillLevels||{};s.skillAwake=s.skillAwake||{};s.settings=Object.assign({hpLimit:45,autoPotion:true,autoBuy:true,autoBoss:true,autoSell:false,autoSkills:[]},s.settings||{});if(!Array.isArray(s.settings.autoSkills))s.settings.autoSkills=[];['weapon','helmet','tshirt','armor','cloak','gloves','boots','amulet','belt','earring1','earring2','ring1','ring2','rune','seal','relic'].forEach(k=>{if(!(k in s.equip))s.equip[k]=null});this.classSkills().filter(sk=>sk.rank==='N'||sk.lv<=4).slice(0,2).forEach(sk=>{s.learnedSkills[sk.id]=true;s.skillLevels[sk.id]=s.skillLevels[sk.id]||1});},tabs(){let t=[['dash','總覽'],['equip','裝備'],['bag','背包'],['hunt','狩獵'],['skills','技能'],['draw','抽卡'],['cards','變身/娃娃'],['combine','合成'],['codex','收藏'],['dungeon','副本'],['boss','世界王'],['guild','血盟'],['craft','製作'],['market','交易所'],['growth','成長'],['pvp','競技場'],['shop','商城'],['ach','成就'],['audit','完整度檢查'],['settings','自動設定']];this.$('tabs').innerHTML=t.map(x=>`<button class="tab" data-tab="${x[0]}">${x[1]}</button>`).join('');this.$('tabs').querySelectorAll('.tab').forEach(b=>b.onclick=()=>{this.tab=b.dataset.tab;this.renderTab()})},cls(){return DB.classes[this.s.cls]},map(){return DB.maps.find(m=>m.id==this.s.map)||DB.maps[0]},need(){return Math.floor(140*Math.pow(this.s.lv,2.12))},classSkills(){return Object.values(DB.skills).filter(sk=>sk.classId===this.s.cls).sort((a,b)=>a.lv-b.lv||R[a.rank][1]-R[b.rank][1])},skillCost(sk){return sk.rank==='N'||sk.lv<=8?0:Math.floor(sk.lv*300+(R[sk.rank][1]-1)*1500)},maxHp(){let st=this.total();return 120+this.s.lv*22+st.con*12+(st.hp||0)},maxMp(){let st=this.total();return 55+this.s.lv*9+st.wis*8+st.int*5+(st.mp||0)},addStat(a,b){let r={...a};for(let k in b)if(typeof b[k]=='number')r[k]=(r[k]||0)+b[k];return r},inv(k){return this.s.inv[k]},def(id){return DB.item[id]},card(id){return DB.cards[id]},total(){let s={...this.s.stats,ac:10,dmg:0,hit:0,dr:0,mr:0,spd:0,hp:0,mp:0};for(let k of Object.values(this.s.equip)){let it=this.inv(k);if(!it)continue;let d=this.def(it.id);if(!d)continue;if(d.ac!==undefined)s.ac+=d.ac-(it.enchant||0);if(d.dmg)s.dmg+=d.dmg+(it.enchant||0);s=this.addStat(s,d.stat||{})}for(let id of [this.s.active.transform,this.s.active.doll])if(id&&this.card(id))s=this.addStat(s,this.card(id).stat);for(let key in this.s.codex)if(this.s.codex[key])s=this.addStat(s,DB.codex[key]?.[2]||{});Object.keys(this.s.learnedSkills).forEach(id=>{let sk=DB.skills[id];if(!sk)return;let lv=this.s.skillLevels[id]||1, aw=this.s.skillAwake[id]?1.5:1;Object.entries(sk.stat||{}).forEach(([k,v])=>s[k]=(s[k]||0)+Math.ceil(v*lv*aw));});s.dmg+=(this.s.growth.mastery||0)*2+(this.s.guild.skill||0);s.mr+=(this.s.growth.magic||0)*3;return s},addItem(id,qty=1,enchant=0){let d=this.def(id);if(!d)return;let stack=['potion','scroll','material','box','book'].includes(d.type);let key=stack?id+'|'+enchant:id+'|'+enchant+'|'+Date.now().toString(36)+Math.random().toString(36).slice(2);if(this.s.inv[key])this.s.inv[key].qty+=qty;else this.s.inv[key]={id,qty,enchant}},rem(k,qty=1){let it=this.inv(k);if(!it)return;it.qty-=qty;if(it.qty<=0){for(let sl in this.s.equip)if(this.s.equip[sl]==k)this.s.equip[sl]=null;delete this.s.inv[k]}},split(k){let it=this.inv(k);if(!it)return null;if(it.qty<=1)return k;it.qty--;let nk=it.id+'|'+it.enchant+'|'+Date.now().toString(36)+Math.random().toString(36).slice(2);this.s.inv[nk]={id:it.id,qty:1,enchant:it.enchant||0};return nk},rand(a,b){return Math.floor(a+Math.random()*(b-a+1))},fmt(n){return Math.floor(n||0).toLocaleString()},bar(id,v,m,pct=false){let p=Math.max(0,Math.min(100,(v||0)/(m||1)*100));this.$(id+'Bar').style.width=p+'%';this.$(id+'Txt').textContent=pct?p.toFixed(2)+'%':`${this.fmt(v)}/${this.fmt(m)}`},tick(){if(!this.s)return;this.s.hp=Math.min(this.maxHp(),(this.s.hp||1)+Math.max(3,this.maxHp()*.025));this.s.mp=Math.min(this.maxMp(),(this.s.mp||1)+Math.max(2,this.maxMp()*.018));if(this.s.leaf<200)this.s.leaf=Math.min(200,this.s.leaf+.05);if(this.s.settings.autoPotion&&this.s.hp/this.maxHp()*100<this.s.settings.hpLimit)this.potion();this.fight();this.renderStatus()},spawn(){let m=this.map(),name=m.mons[this.rand(0,m.mons.length-1)],lv=this.rand(m.min,m.max);let boss=/王|龍|安塔|巴拉/.test(name);if(boss&&!this.s.settings.autoBoss)boss=false;this.s.mon={name,lv,boss,hp:Math.floor((boss?1200:120)+lv*(boss?70:22)),max:0};this.s.mon.max=this.s.mon.hp;this.blog('遭遇 '+name+(boss?' <span class="orange">BOSS</span>':''))},castAuto(){let arr=this.s.settings.autoSkills||[];for(let id of arr){let sk=DB.skills[id];if(!sk||!this.s.learnedSkills[id]||sk.type==='passive'||this.s.mp<(sk.mp||0))continue;let lv=this.s.skillLevels[id]||1, aw=this.s.skillAwake[id]?1.3:1;this.s.mp-=sk.mp;if(sk.type==='active'){let dmg=Math.floor((sk.power+lv*22+this.total().int*3)*aw);this.s.mon.hp-=dmg;this.blog(`<span class="cyan">自動施放 ${sk.name}</span>，造成 ${dmg} 技能傷害`);return}else{this.s.hp=Math.min(this.maxHp(),this.s.hp+Math.floor((50+lv*18)*aw));this.blog(`<span class="green">自動施放 ${sk.name}</span>`);return}}},fight(){if(!this.s.mon||this.s.mon.hp<=0)this.spawn();this.castAuto();if(this.s.mon.hp<=0){this.kill(this.s.mon,this.s.leaf>0?1.25:1);return}let st=this.total(),m=this.s.mon,leafBonus=this.s.leaf>0?1.25:1;if(this.s.leaf>0)this.s.leaf=Math.max(0,this.s.leaf-.03);let dmg=Math.max(1,Math.floor((st.dmg+this.s.lv*2+st.str*1.5+st.dex*.6)*(1+st.spd/100)));m.hp-=dmg;this.blog(`造成 ${dmg} 傷害給 ${m.name}`);if(m.hp<=0){this.kill(m,leafBonus);return}let take=Math.max(1,Math.floor(m.lv*1.2+(m.boss?40:8)-(10-st.ac)*1.4-(st.dr||0)));this.s.hp-=take;if(this.s.hp<=0){this.s.hp=this.maxHp()*.55;this.s.exp=Math.max(0,this.s.exp-this.need()*.02);this.s.mon=null;this.blog('<span class="red">瀕死回城，損失少量經驗</span>')}},kill(m,bonus){this.s.ach.kills++;this.s.daily.kills++;if(m.boss)this.s.ach.boss++;let exp=Math.floor((20+m.lv*m.lv*1.6)*(m.boss?3:1)*bonus), ad=this.rand(m.lv*20,m.lv*(m.boss?220:55));this.s.exp+=exp;this.s.adena+=ad;let drops=this.map().drops;if(Math.random()<.42){let id=drops[this.rand(0,drops.length-1)];this.addItem(id,1,0);this.log('掉落：'+this.def(id).name,'green')}this.dropDiamond(m);this.checkDiamondQuest();this.level();this.s.mon=null;this.autoSell()},dropDiamond(m){let map=this.map(),rate=.005,min=1,max=3,label='一般怪';if(['gludin','giran'].includes(map.id)){rate=.03;min=3;max=10;label='地監/菁英怪'}if(['dragon','toi','lastabad'].includes(map.id)){rate=.05;min=5;max=15;label='高階地圖'}if(['antharas','valakas'].includes(map.id)){rate=.08;min=10;max=35;label='四龍地區'}if(m.boss){rate=.30;min=20;max=100;label='野外Boss'}if(Math.random()<rate)this.gainDiamond(this.rand(min,max),label+'掉落：'+m.name)},gainDiamond(n,reason){n=Math.floor(n||0);if(n<=0)return;this.s.diamond+=n;this.s.ach.diamond+=n;this.s.diamondLog.unshift({t:Date.now(),n,reason});this.s.diamondLog=this.s.diamondLog.slice(0,25);this.log(`<span class="cyan">鑽石 +${n}</span>｜${reason}`,'green')},checkDiamondQuest(){for(let [need,reward] of [[10,50],[100,200],[500,500]])if(this.s.daily.kills>=need&&this.s.daily.diamondQuest<need){this.s.daily.diamondQuest=need;this.s.ach.dailyDiamond+=reward;this.gainDiamond(reward,'每日狩獵任務 '+need+' 隻')}},level(){while(this.s.exp>=this.need()&&this.s.lv<99){this.s.exp-=this.need();this.s.lv++;this.s.hp=this.maxHp();this.s.mp=this.maxMp();this.s.diamond+=20;this.log('升級 Lv.'+this.s.lv,'gold')}},potion(){let k=Object.keys(this.s.inv).find(k=>['potion_red','potion_orange','potion_clear'].includes(this.inv(k).id));if(!k&&this.s.settings.autoBuy&&this.s.adena>=4500){this.s.adena-=4500;this.addItem('potion_red',100);k=Object.keys(this.s.inv).find(k=>this.inv(k).id=='potion_red');this.log('自動購買紅水 ×100')}if(k){let d=this.def(this.inv(k).id);this.s.hp=Math.min(this.maxHp(),this.s.hp+d.heal);this.rem(k,1);this.blog('自動喝水：'+d.name)}},autoSell(){if(!this.s.settings.autoSell)return;for(let k of Object.keys(this.s.inv)){let it=this.inv(k),d=this.def(it.id);if(d&&d.rank=='N'&&!['potion','scroll','material','book'].includes(d.type)){this.s.adena+=Math.floor(d.price*.3)*(it.qty||1);this.rem(k,it.qty||1)}}},learnSkill(id,free=false){this.ensure();let sk=DB.skills[id];if(!sk)return alert('找不到技能');if(sk.classId!==this.s.cls)return alert('非本職業技能');if(this.s.learnedSkills[id]){this.log('已學會技能：'+sk.name,'gold');this.render();return}let book=Object.keys(this.s.inv).find(k=>this.def(this.inv(k).id)?.skill===id);let cost=free?0:this.skillCost(sk);if(book){this.rem(book,1);cost=0}else if(this.s.adena<cost){this.log('金幣不足，核心修復模式已免費學習：'+sk.name,'gold');cost=0}if(cost>0)this.s.adena-=cost;this.s.learnedSkills[id]=true;this.s.skillLevels[id]=1;this.log('學會技能：'+sk.name+(cost?'，花費 '+this.fmt(cost)+' 金幣':''),'green');this.save(false);this.render()},upgradeSkill(id){let sk=DB.skills[id];if(!sk)return;if(!this.s.learnedSkills[id])return this.learnSkill(id,true);let lv=this.s.skillLevels[id]||1;if(lv>=10)return alert('技能已達 Lv.10');this.s.skillLevels[id]=lv+1;this.log('技能升級：'+sk.name+' Lv.'+(lv+1),'green');this.render()},awakeSkill(id){let sk=DB.skills[id];if(!sk)return;if(!this.s.learnedSkills[id])this.learnSkill(id,true);this.s.skillAwake[id]=true;this.log('技能覺醒：'+sk.name,'gold');this.render()},toggleAutoSkill(id){let sk=DB.skills[id];if(!sk)return;if(!this.s.learnedSkills[id])this.learnSkill(id,true);if(sk.type==='passive')return alert('被動技能不需要自動施放');let arr=this.s.settings.autoSkills||[];this.s.settings.autoSkills=arr.includes(id)?arr.filter(x=>x!==id):arr.concat(id);this.render()},draw(kind,times=1){let cost=kind=='transform'?120:100;if(this.s.diamond<cost*times)return alert('鑽石不足');this.s.diamond-=cost*times;let got=[];for(let i=0;i<times;i++){let r=Math.random(),rank=r>.997?'M':r>.985?'L':r>.92?'SSR':r>.7?'SR':r>.35?'R':'N';let pool=Object.values(DB.cards).filter(c=>c.kind==kind&&c.rank==rank);let c=pool[this.rand(0,pool.length-1)]||Object.values(DB.cards).find(c=>c.kind==kind);this.s.cards[c.id]=(this.s.cards[c.id]||0)+1;got.push(`<span class="r-${c.rank}">${c.name}</span>`)}this.s.ach.draw+=times;this.log('抽卡結果：'+got.join('、'),'green');this.render()},combine(kind,rank){let ids=Object.keys(this.s.cards).filter(id=>this.card(id).kind==kind&&this.card(id).rank==rank&&this.s.cards[id]>0),total=ids.reduce((a,id)=>a+this.s.cards[id],0);if(total<4)return alert('需要4張同階卡');let n=4;for(let id of ids)while(this.s.cards[id]>0&&n>0){this.s.cards[id]--;n--}let order=['N','R','SR','SSR','L','M'],next=order[Math.min(order.length-1,order.indexOf(rank)+1)],success=Math.random()<({N:.75,R:.55,SR:.35,SSR:.18,L:.06}[rank]||.02),final=success?next:rank,pool=Object.values(DB.cards).filter(c=>c.kind==kind&&c.rank==final),c=pool[this.rand(0,pool.length-1)];this.s.cards[c.id]=(this.s.cards[c.id]||0)+1;this.log(`合成${success?'成功':'失敗'}：${c.name}`,'green');this.render()},equip(k){let d=this.def(this.inv(k).id);if(d.type=='weapon'&&!this.cls().weapons.includes(d.weapon))return alert('職業無法裝備');k=this.split(k);let slot=d.type;if(d.type=='ring')slot=this.s.equip.ring1?'ring2':'ring1';if(d.type=='earring')slot=this.s.equip.earring1?'earring2':'earring1';this.s.equip[slot]=k;this.render()},enchant(k){k=this.split(k);let it=this.inv(k),d=this.def(it.id),target=d.type=='weapon'?'weapon':(['ring','earring','amulet','belt','rune','seal','relic'].includes(d.type)?'accessory':'armor'),sk=Object.keys(this.s.inv).find(x=>this.def(this.inv(x).id).type=='scroll'&&this.def(this.inv(x).id).target==target);if(!sk)return alert('沒有卷軸');this.rem(sk,1);let safe=d.safe||0,rate=it.enchant<safe?1:Math.max(.03,.68-(it.enchant-safe)*.13);if(Math.random()<rate){it.enchant++;this.log(d.name+' 強化成功 +'+it.enchant,'green')}else{this.log(d.name+' 強化失敗，裝備消失','red');this.rem(k,99)}this.render()},use(k){let it=this.inv(k),d=this.def(it.id);if(d.type=='potion'){this.s.hp=Math.min(this.maxHp(),this.s.hp+d.heal);this.rem(k,1)}else if(d.id=='leaf_box'){this.s.leaf=Math.min(200,this.s.leaf+50);this.rem(k,1)}else if(d.type==='book'&&d.skill){this.learnSkill(d.skill,true);this.rem(k,1)}this.render()},sell(k){let it=this.inv(k),d=this.def(it.id);this.s.adena+=Math.floor(d.price*.35)*(it.qty||1);this.rem(k,it.qty||1);this.render()},dungeon(id){let d=DB.dungeons.find(x=>x.id==id);if(this.s.daily.dungeon<=0)return alert('今日副本次數不足');if(this.s.lv<d.lv)return alert('等級不足');if(this.s.diamond<d.cost)return alert('鑽石不足');this.s.daily.dungeon--;this.s.diamond-=d.cost;this.s.adena+=d.reward;this.s.exp+=this.need()*.08;this.addItem('mat'+this.rand(0,9),this.rand(1,3));this.gainDiamond(d.name.includes('龍')||d.name.includes('世界')||d.name.includes('四龍')?this.rand(100,500):this.rand(20,100),'副本完成：'+d.name);this.level();this.render()},boss(id){let b=DB.bosses.find(x=>x.id==id);if(this.s.daily.boss<=0)return alert('世界王次數不足');if(this.s.lv<b.lv-15)return alert('等級不足');this.s.daily.boss--;this.s.adena+=b.lv*1500;this.s.exp+=this.need()*.12;this.addItem(['scroll_bless_weapon','scroll_bless_armor','mat7','leaf_box'][this.rand(0,3)],1);this.gainDiamond(/安塔|巴拉|法利|林德|吉爾/.test(b.name)?this.rand(1000,5000):this.rand(100,1000),'世界Boss討伐：'+b.name);this.s.ach.boss++;this.level();this.render()},matCount(){return Object.values(this.s.inv).filter(x=>this.def(x.id)?.type=='material').reduce((a,x)=>a+x.qty,0)},consumeMat(n){for(let k of Object.keys(this.s.inv)){if(n<=0)break;if(this.def(this.inv(k).id)?.type!='material')continue;let q=Math.min(n,this.inv(k).qty);this.rem(k,q);n-=q}},craft(id){let d=this.def(id),need=R[d.rank][1]*3,cost=d.price*2;if(this.matCount()<need||this.s.adena<cost)return alert('材料或金幣不足');this.consumeMat(need);this.s.adena-=cost;this.addItem(id,1,0);this.s.ach.craft++;this.log('製作完成：'+d.name,'green');this.render()},checkCodex(i){let c=DB.codex[i],ok=c[1].every(id=>DB.cards[id]?this.s.cards[id]>0:Object.values(this.s.inv).some(x=>x.id==id));if(!ok)return alert('收藏條件不足');this.s.codex[i]=true;this.log('完成收藏：'+c[0],'green');this.render()},action(a,arg){if(a=='equip')this.equip(arg);else if(a=='ench')this.enchant(arg);else if(a=='use'||a=='useBook')this.use(arg);else if(a=='sell')this.sell(arg);else if(a=='drawT')this.draw('transform',+arg);else if(a=='drawD')this.draw('doll',+arg);else if(a=='active'){let card=this.card(arg);this.s.active[card.kind]=arg;this.render()}else if(a=='combine'){let [k,r]=arg.split('|');this.combine(k,r)}else if(a=='dg')this.dungeon(arg);else if(a=='boss')this.boss(arg);else if(a=='craft')this.craft(arg);else if(a=='codex')this.checkCodex(+arg);else if(a=='learnSkill')this.learnSkill(arg);else if(a=='forceLearnSkill')this.learnSkill(arg,true);else if(a=='learnAllSkills'){this.classSkills().forEach(sk=>{if(!this.s.learnedSkills[sk.id]){this.s.learnedSkills[sk.id]=true;this.s.skillLevels[sk.id]=1}});this.log('已解鎖本職業全部技能','green');this.render()}else if(a=='addSkillBooks'){this.classSkills().forEach(sk=>this.addItem('book_'+sk.id,1));this.log('已補發本職業技能書','green');this.render()}else if(a=='upgradeSkill')this.upgradeSkill(arg);else if(a=='awakeSkill')this.awakeSkill(arg);else if(a=='autoSkill')this.toggleAutoSkill(arg);else if(a=='donate'){if(this.s.adena>=10000){this.s.adena-=10000;this.s.guild.donate++;if(this.s.guild.donate%5==0)this.s.guild.lv++;this.render()}}else if(a=='guildskill'){if(this.s.guild.donate>=3){this.s.guild.donate-=3;this.s.guild.skill++;this.render()}}else if(a=='growth'){let cost=(this.s.growth[arg]+1)*100000;if(this.s.adena>=cost){this.s.adena-=cost;this.s.growth[arg]++;this.render()}}else if(a=='pvp'){let win=Math.random()<.55+(this.total().dmg/300);this.s.adena+=win?5000:1000;this.gainDiamond(win?15:3,win?'競技場勝利':'競技場參加');this.render()}else if(a=='buy'){if(this.s.diamond>=100){this.s.diamond-=100;this.addItem(arg,1);this.render()}}else if(a=='tj'){if(this.s.daily.tj>0){this.s.daily.tj--;this.addItem('scroll_bless_weapon',1);this.addItem('scroll_bless_armor',1);this.s.cards.t_skel=(this.s.cards.t_skel||0)+1;this.log('TJ補償：祝武、祝防、稀有變身卡','green');this.render()}}else if(a=='mail'){this.s.diamond+=300;this.addItem('leaf_box',3);this.log('每日信箱：鑽石 +300、葉子箱 +3','green');this.render()}this.save(false)},render(){this.renderStatus();this.renderTab()},renderStatus(){let st=this.total();this.s.hp=Math.min(this.s.hp,this.maxHp());this.s.mp=Math.min(this.s.mp,this.maxMp());this.$('className').textContent=this.cls().name;this.$('subtitle').textContent=`Lv.${this.s.lv} ${this.cls().name}｜${this.map().name}｜變身 ${this.s.active.transform?this.card(this.s.active.transform).name:'未啟用'}｜娃娃 ${this.s.active.doll?this.card(this.s.active.doll).name:'未召喚'}`;this.$('lv').textContent=this.s.lv;this.$('adena').textContent=this.fmt(this.s.adena);this.$('diamond').textContent=this.fmt(this.s.diamond);this.bar('hp',this.s.hp,this.maxHp());this.bar('mp',this.s.mp,this.maxMp());this.bar('exp',this.s.exp,this.need(),true);this.bar('leaf',this.s.leaf,200);this.$('statBox').innerHTML=[`STR ${st.str}`,`DEX ${st.dex}`,`CON ${st.con}`,`INT ${st.int}`,`WIS ${st.wis}`,`AC ${st.ac}`,`傷害 +${Math.floor(st.dmg+this.s.lv*2)}`,`命中 ${st.hit||0}`,`減傷 ${st.dr||0}`,`MR ${st.mr||0}`].map(x=>`<div class="stat">${x}</div>`).join('');this.$('mapSelect').value=this.s.map;this.$('mapInfo').textContent=`${this.map().name}｜建議 Lv.${this.map().min}-${this.map().max}｜掉落：${this.map().drops.map(id=>this.def(id).name).join('、')}`;this.$('monsterName').innerHTML=this.s.mon?E(this.s.mon.name):'尋找中';this.bar('mon',this.s.mon?this.s.mon.hp:0,this.s.mon?this.s.mon.max:1)},renderTab(){this.$('tabs').querySelectorAll('.tab').forEach(b=>b.classList.toggle('on',b.dataset.tab==this.tab));let map={dash:'viewDash',equip:'viewEquip',bag:'viewBag',hunt:'viewHunt',skills:'viewSkills',draw:'viewDraw',cards:'viewCards',combine:'viewCombine',codex:'viewCodex',dungeon:'viewDungeon',boss:'viewBoss',guild:'viewGuild',craft:'viewCraft',market:'viewMarket',growth:'viewGrowth',pvp:'viewPvp',shop:'viewShop',ach:'viewAch',audit:'viewAudit',settings:'viewSettings'};this.$('content').innerHTML=this[map[this.tab]||'viewDash']()},slots(){return{weapon:'武器',helmet:'頭盔',tshirt:'內衣',armor:'盔甲',cloak:'斗篷',gloves:'手套',boots:'鞋子',amulet:'項鍊',belt:'腰帶',earring1:'耳環1',earring2:'耳環2',ring1:'戒指1',ring2:'戒指2',rune:'符石',seal:'印章',relic:'聖物'}},name(k){let it=this.inv(k),d=this.def(it.id);return `<span class="r-${d.rank}">${it.enchant?'+'+it.enchant+' ':''}${E(d.name)}${it.qty>1?' ×'+it.qty:''}</span>`},viewDash(){let st=this.total();return `<h3 class="title">總覽</h3><div class="grid cards"><div class="card"><b>戰力</b><div class="big gold">${this.fmt(st.dmg*12+this.s.lv*30+(10-st.ac)*8+st.dr*20)}</div><span class="muted">等級、裝備、卡片、收藏、血盟、技能全部進核心計算。</span></div><div class="card"><b>今日資源</b><p>副本 ${this.s.daily.dungeon}｜世界王 ${this.s.daily.boss}｜TJ ${this.s.daily.tj}</p><button data-act="mail">領取每日信箱</button> <button data-act="tj" class="gold">TJ補償</button></div><div class="card"><b>核心重寫狀態</b><p class="muted">已移除原本多段補丁覆寫方式，所有按鈕統一走單一事件核心，技能學習/升級/覺醒/自動施放都在同一邏輯內。</p></div></div>`},viewEquip(){return `<h3 class="title">裝備 / 符石 / 印章 / 聖物</h3>`+Object.entries(this.slots()).map(([s,n])=>`<div class="item row"><span>${n}</span><span>${this.s.equip[s]?this.name(this.s.equip[s]):'<span class="muted">未裝備</span>'}</span></div>`).join('')},viewBag(){let rows=Object.keys(this.s.inv).map(k=>{let d=this.def(this.inv(k).id);let eq=['weapon','helmet','tshirt','armor','cloak','gloves','boots','amulet','belt','earring','ring','rune','seal','relic'].includes(d.type);return `<div class="item split"><span>${this.name(k)} <span class="muted">${d.type}</span></span><span>${eq?`<button data-act="equip" data-arg="${k}">裝備</button> <button data-act="ench" data-arg="${k}">強化</button>`:''} ${['potion','box','book'].includes(d.type)?`<button data-act="use" data-arg="${k}">${d.type==='book'?'學習':'使用'}</button>`:''} <button data-act="sell" data-arg="${k}" class="red">賣出</button></span></div>`}).join('');return `<h3 class="title">背包</h3>${rows||'<p class="muted">空</p>'}`},viewHunt(){return `<h3 class="title">狩獵設定</h3><div class="card"><b class="cyan">鑽石掉落規則</b><br>一般怪 0.5%：1~3鑽｜地監/菁英 3%：3~10鑽｜高階地圖 5%：5~15鑽｜野外Boss 30%：20~100鑽｜世界Boss 100%：100~1000鑽｜四龍Boss 100%：1000~5000鑽</div>${DB.maps.map(m=>`<div class="card item"><b>${m.name}</b> Lv.${m.min}-${m.max}<br><span class="muted">怪物：${m.mons.join('、')}｜掉落：${m.drops.map(id=>this.def(id).name).join('、')}</span></div>`).join('')}`},viewSkills(){let mine=this.classSkills(),learned=mine.filter(sk=>this.s.learnedSkills[sk.id]).length;let rows=mine.map(sk=>{let is=!!this.s.learnedSkills[sk.id],lv=this.s.skillLevels[sk.id]||0,auto=this.s.settings.autoSkills.includes(sk.id),awake=!!this.s.skillAwake[sk.id],stat=Object.entries(sk.stat||{}).map(([k,v])=>k+'+'+v).join('、')||'-',cost=this.skillCost(sk);let btn=is?`<span class="green">已學 Lv.${lv}${awake?'｜已覺醒':''}</span> <button data-act="upgradeSkill" data-arg="${sk.id}">升級</button> <button data-act="awakeSkill" data-arg="${sk.id}">覺醒</button> ${sk.type!=='passive'?`<button data-act="autoSkill" data-arg="${sk.id}" class="${auto?'gold':''}">${auto?'取消自動':'自動施放'}</button>`:''}`:`<button data-act="learnSkill" data-arg="${sk.id}" class="gold">學習</button> <button data-act="forceLearnSkill" data-arg="${sk.id}">強制學習</button>`;return `<div class="card item"><div class="row"><b class="r-${sk.rank}">${E(sk.name)}</b><span>${sk.typeName}｜${R[sk.rank][0]}｜需求Lv.${sk.lv}</span></div><div class="muted">MP ${sk.mp}｜威力 ${sk.power||'-'}｜費用 ${this.fmt(cost)} 金幣｜加成：${E(stat)}</div><div class="muted">${E(sk.desc)}</div><div style="margin-top:8px">${btn}</div></div>`}).join('');return `<h3 class="title">技能核心</h3><div class="card"><b class="gold">${this.cls().name}</b><br><span class="muted">已學 ${learned}/${mine.length}。學習按鈕不再被舊補丁覆蓋；金幣不足時會啟用修復模式免費學習，避免卡死。</span><br><button data-act="learnAllSkills" class="gold">一鍵解鎖本職業全部技能</button> <button data-act="addSkillBooks">補發本職業技能書</button></div>${rows}`},viewDraw(){return `<h3 class="title">抽卡 / 卡池</h3><div class="grid cards"><div class="card"><b>變身抽卡</b><p class="muted">一般～神話機率抽取</p><button data-act="drawT" data-arg="1">抽1次 120鑽</button> <button data-act="drawT" data-arg="11" class="gold">抽11次 1320鑽</button></div><div class="card"><b>魔法娃娃抽卡</b><p class="muted">一般～神話機率抽取</p><button data-act="drawD" data-arg="1">抽1次 100鑽</button> <button data-act="drawD" data-arg="11" class="gold">抽11次 1100鑽</button></div></div>`},viewCards(){return `<h3 class="title">變身 / 魔法娃娃</h3>`+Object.values(DB.cards).map(c=>`<div class="item row"><span class="r-${c.rank}">${c.kind=='transform'?'變身':'娃娃'}｜${c.name} ×${this.s.cards[c.id]||0}</span><span>${this.s.cards[c.id]?`<button data-act="active" data-arg="${c.id}">啟用</button>`:''}</span></div>`).join('')},viewCombine(){let ranks=['N','R','SR','SSR','L'];return `<h3 class="title">卡片合成</h3><p class="muted">4張同階卡可合成，成功升階，失敗維持同階隨機卡。</p><div class="grid cards"><div class="card"><b>變身合成</b><br>${ranks.map(r=>`<button data-act="combine" data-arg="transform|${r}">${R[r][0]}</button>`).join(' ')}</div><div class="card"><b>娃娃合成</b><br>${ranks.map(r=>`<button data-act="combine" data-arg="doll|${r}">${R[r][0]}</button>`).join(' ')}</div></div>`},viewCodex(){return `<h3 class="title">收藏系統</h3>`+DB.codex.map((c,i)=>`<div class="card item"><b>${c[0]}</b> ${this.s.codex[i]?'<span class="green">已完成</span>':'<span class="muted">未完成</span>'}<br><span class="muted">需求：${c[1].map(id=>DB.item[id]?.name||DB.cards[id]?.name).join('、')}｜加成：${Object.entries(c[2]).map(x=>x.join('+')).join('、')}</span><br><button data-act="codex" data-arg="${i}">登錄收藏</button></div>`).join('')},viewDungeon(){return `<h3 class="title">副本 / 活動</h3><p>今日剩餘：${this.s.daily.dungeon}</p>`+DB.dungeons.map(d=>`<div class="item row"><span>${d.name} <span class="muted">Lv.${d.lv}｜${d.cost}鑽｜獎勵 ${this.fmt(d.reward)}</span></span><button data-act="dg" data-arg="${d.id}">進入</button></div>`).join('')},viewBoss(){return `<h3 class="title">世界王 / 四龍</h3><p>今日剩餘：${this.s.daily.boss}</p>`+DB.bosses.map(b=>`<div class="item row"><span>${b.name} <span class="muted">Lv.${b.lv}｜HP ${this.fmt(b.hp)}</span></span><button data-act="boss" data-arg="${b.id}">討伐</button></div>`).join('')},viewGuild(){return `<h3 class="title">血盟</h3><div class="card"><b>${this.s.guild.name}</b><p>血盟Lv.${this.s.guild.lv}｜貢獻 ${this.s.guild.donate}｜血盟技能 +${this.s.guild.skill} 傷害</p><button data-act="donate">捐獻 10,000金幣</button> <button data-act="guildskill" class="gold">升級血盟技能 3貢獻</button></div>`},viewCraft(){let list=Object.values(DB.item).filter(d=>['SSR','L','M'].includes(d.rank)&&['weapon','armor','ring','earring','relic','rune','seal'].includes(d.type));return `<h3 class="title">製作 / 材料</h3><p>通用材料數：${this.matCount()}</p>`+list.map(d=>`<div class="item row"><span class="r-${d.rank}">${d.name} <span class="muted">需要材料 ${R[d.rank][1]*3} / 金幣 ${this.fmt(d.price*2)}</span></span><button data-act="craft" data-arg="${d.id}">製作</button></div>`).join('')},viewMarket(){return `<h3 class="title">交易所</h3><p class="muted">單機模擬掛單，與核心道具庫共用。</p>`+Object.values(DB.item).filter(d=>d.type!=='book').slice(0,25).map(d=>`<div class="item row"><span class="r-${d.rank}">${d.name}</span><span>${this.fmt(d.price)} 金幣</span></div>`).join('')},viewGrowth(){return `<h3 class="title">成長 / 紋樣 / 守護星盤</h3>`+[['mastery','武器熟練'],['magic','魔法研究'],['pvp','競技訓練']].map(x=>`<div class="card item"><b>${x[1]}</b> Lv.${this.s.growth[x[0]]}<br><span class="muted">升級費用 ${(this.s.growth[x[0]]+1)*100000} 金幣</span><br><button data-act="growth" data-arg="${x[0]}">升級</button></div>`).join('')},viewPvp(){return `<h3 class="title">競技場 / 排行榜</h3><button data-act="pvp" class="gold">挑戰競技場</button><div class="grid cards" style="margin-top:10px">${['肯恩','絲莉安','甘特','卡士柏','Sam'].map((n,i)=>`<div class="card">#${i+1} ${n}<br><span class="muted">戰力 ${this.fmt(90000-i*8000+this.rand(0,2000))}</span></div>`).join('')}</div>`},viewShop(){return `<h3 class="title">商城 / 補給</h3><p class="muted">使用鑽石購買補給。</p>`+['leaf_box','scroll_bless_weapon','scroll_bless_armor','potion_clear'].map(id=>`<div class="item row"><span>${this.def(id).name}</span><button data-act="buy" data-arg="${id}">購買 100鑽</button></div>`).join('')},viewAch(){let log=(this.s.diamondLog||[]).map(x=>`<div class="item row"><span>${new Date(x.t).toLocaleTimeString()}｜${E(x.reason)}</span><b class="cyan">+${x.n}</b></div>`).join('');return `<h3 class="title">成就 / 鑽石經濟</h3><div class="grid cards"><div class="card">擊殺：${this.s.ach.kills}<br><span class="muted">今日 ${this.s.daily.kills||0} 隻</span></div><div class="card">Boss：${this.s.ach.boss}</div><div class="card">抽卡：${this.s.ach.draw}</div><div class="card">製作：${this.s.ach.craft}</div><div class="card"><b class="cyan">怪物/任務累計鑽石</b><br>${this.fmt(this.s.ach.diamond||0)}</div><div class="card"><b class="gold">每日任務鑽石</b><br>${this.fmt(this.s.ach.dailyDiamond||0)}</div></div><h4 class="title">最近鑽石取得紀錄</h4>${log||'<p class="muted">尚無鑽石掉落紀錄</p>'}`},viewAudit(){let items=Object.values(DB.item),miss=DB.maps.flatMap(m=>m.drops.filter(id=>!DB.item[id]).map(id=>m.name+':'+id));return `<h3 class="title">完整度檢查</h3><div class="grid cards"><div class="card"><b>職業</b><div class="big gold">${Object.keys(DB.classes).length}</div></div><div class="card"><b>地圖</b><div class="big gold">${DB.maps.length}</div></div><div class="card"><b>怪物</b><div class="big gold">${new Set(DB.maps.flatMap(m=>m.mons)).size}</div></div><div class="card"><b>裝備/道具</b><div class="big gold">${items.length}</div></div><div class="card"><b>變身</b><div class="big gold">${Object.values(DB.cards).filter(c=>c.kind==='transform').length}</div></div><div class="card"><b>魔法娃娃</b><div class="big gold">${Object.values(DB.cards).filter(c=>c.kind==='doll').length}</div></div><div class="card"><b>技能</b><div class="big gold">${Object.keys(DB.skills).length}</div><span class="muted">技能書 ${items.filter(x=>x.type==='book').length}</span></div></div><div class="card"><b>${miss.length?'資料關聯仍有缺漏':'資料關聯檢查通過'}</b><br><span class="muted">掉落表缺失：${miss.length?miss.join('、'):'無'}</span></div>`},viewSettings(){let s=this.s.settings;return `<h3 class="title">自動設定</h3><label class="item row">HP低於%自動喝水 <input data-set="hpLimit" type="number" min="1" max="99" value="${s.hpLimit}"></label><label class="item row">啟用自動喝水 <input data-set="autoPotion" type="checkbox" ${s.autoPotion?'checked':''}></label><label class="item row">自動買水 <input data-set="autoBuy" type="checkbox" ${s.autoBuy?'checked':''}></label><label class="item row">自動挑戰野外Boss <input data-set="autoBoss" type="checkbox" ${s.autoBoss?'checked':''}></label><label class="item row">自動販售一般裝備 <input data-set="autoSell" type="checkbox" ${s.autoSell?'checked':''}></label>`},save(show){this.s.last=Date.now();Store.save(this.s);if(show)this.log('已儲存')},export(){let blob=new Blob([JSON.stringify(this.s,null,2)],{type:'application/json'}),a=document.createElement('a');a.href=URL.createObjectURL(blob);a.download='lineageM_core_rebuild_save.json';a.click()},import(e){let f=e.target.files[0];if(!f)return;let r=new FileReader();r.onload=()=>{this.s=JSON.parse(r.result);this.enter()};r.readAsText(f)},offline(){if(!this.s)return;let sec=Math.min(21600,Math.floor((Date.now()-(this.s.last||Date.now()))/1000));if(sec>60){let gain=sec*(this.s.lv*5);this.s.adena+=gain;this.s.exp+=sec*(this.s.lv*2);this.log(`離線收益 ${Math.floor(sec/60)} 分鐘，金幣 +${this.fmt(gain)}`);this.level()}},log(t,cls=''){let el=this.$('sysLog');if(el)el.innerHTML=`<div class="${cls}">[${new Date().toLocaleTimeString()}] ${t}</div>`+el.innerHTML},blog(t){let el=this.$('battleLog');if(el)el.innerHTML=`<div>[${new Date().toLocaleTimeString()}] ${t}</div>`+el.innerHTML;if(el&&el.children.length>80)el.lastChild.remove()}};
window.DB=DB;window.G=Game;
/* === V15.1 STATUS BAR HOTFIX ===
   修復舊存檔/遷移資料造成 stats、hp、mp、leaf、exp 為 undefined/NaN 時，
   HP/MP/EXP/葉子狀態列不顯示的問題；同時補上文字 z-index。 */
(function(){
  const oldEnsure = Game.ensure.bind(Game);
  const finite = (v, fallback=0) => Number.isFinite(Number(v)) ? Number(v) : fallback;
  const mergeBaseStats = function(){
    if(!Game.s) return;
    const c = DB.classes[Game.s.cls] || DB.classes.knight;
    Game.s.cls = c.id;
    Game.s.stats = Object.assign({}, c.stats || {}, Game.s.stats || {});
    ['str','dex','con','int','wis'].forEach(k=>Game.s.stats[k]=finite(Game.s.stats[k], (c.stats||{})[k]||10));
    Game.s.lv = Math.max(1, Math.min(99, Math.floor(finite(Game.s.lv,1))));
    Game.s.exp = Math.max(0, finite(Game.s.exp,0));
    Game.s.adena = Math.max(0, finite(Game.s.adena,0));
    Game.s.diamond = Math.max(0, finite(Game.s.diamond,0));
    Game.s.leaf = Math.max(0, Math.min(200, finite(Game.s.leaf,200)));
    Game.s.hp = Math.max(1, finite(Game.s.hp,1));
    Game.s.mp = Math.max(0, finite(Game.s.mp,0));
  };
  Game.ensure = function(){ oldEnsure(); mergeBaseStats(); };
  Game.maxHp = function(){ const st=this.total(); return Math.max(1, Math.floor(120+this.s.lv*22+finite(st.con,10)*12+finite(st.hp,0))); };
  Game.maxMp = function(){ const st=this.total(); return Math.max(1, Math.floor(55+this.s.lv*9+finite(st.wis,10)*8+finite(st.int,10)*5+finite(st.mp,0))); };
  Game.bar = function(id,v,m,pct=false){
    const bar=this.$(id+'Bar'), txt=this.$(id+'Txt');
    const max=Math.max(1, finite(m,1));
    const val=Math.max(0, Math.min(max, finite(v,0)));
    const p=Math.max(0, Math.min(100, val/max*100));
    if(bar) bar.style.width=p+'%';
    if(txt) txt.textContent=pct ? p.toFixed(2)+'%' : `${this.fmt(val)}/${this.fmt(max)}`;
  };
  const oldRenderStatus = Game.renderStatus.bind(Game);
  Game.renderStatus = function(){
    this.ensure();
    this.s.hp=Math.min(this.s.hp,this.maxHp());
    this.s.mp=Math.min(this.s.mp,this.maxMp());
    try { oldRenderStatus(); }
    catch(err){
      console.warn('renderStatus fallback:', err);
      const st=this.total();
      this.$('className').textContent=this.cls().name;
      this.$('lv').textContent=this.s.lv;
      this.$('adena').textContent=this.fmt(this.s.adena);
      this.$('diamond').textContent=this.fmt(this.s.diamond);
      this.bar('hp',this.s.hp,this.maxHp());
      this.bar('mp',this.s.mp,this.maxMp());
      this.bar('exp',this.s.exp,this.need(),true);
      this.bar('leaf',this.s.leaf,200);
      this.$('statBox').innerHTML=[`STR ${st.str}`,`DEX ${st.dex}`,`CON ${st.con}`,`INT ${st.int}`,`WIS ${st.wis}`,`AC ${st.ac}`,`傷害 +${Math.floor(st.dmg+this.s.lv*2)}`,`命中 ${st.hit||0}`,`減傷 ${st.dr||0}`,`MR ${st.mr||0}`].map(x=>`<div class="stat">${x}</div>`).join('');
    }
  };
})();

/* === V16 OFFICIAL-BALANCE CORE REWRITE ===
   目標：移除不合理的GM/補償/暴利設定，將核心改為較接近天堂M的成長節奏。
   注意：單機模擬版不連接官方伺服器，資料與機率為遊戲性近似，不宣稱等同官方最新資料。 */
(function(){
  const finite=(v,f=0)=>Number.isFinite(Number(v))?Number(v):f;
  const pick=(a)=>a[Math.floor(Math.random()*a.length)];
  document.title='天堂M Core Rebuild V16｜官方平衡模擬核心';
  const mainTitle=document.querySelector('#app .top .title'); if(mainTitle) mainTitle.textContent='天堂M Core Rebuild V27';
  const startTitle=document.querySelector('#start h1'); if(startTitle) startTitle.textContent='天堂M Core Rebuild V16';
  const startDesc=document.querySelector('#start p'); if(startDesc) startDesc.textContent='單機HTML｜離線存檔｜官方平衡模擬核心：移除GM補償、免費解鎖與過高鑽石掉落；整合職業、地圖、怪物、裝備、強化、技能、變身、娃娃、副本、Boss、血盟、收藏、製作、交易所、商城、PVP。';

  // 新存檔key，避免舊版高資源污染；仍可讀舊存檔並遷移修正。
  Store.key='lm_core_rebuild_v16_official_balance';
  Store.save=s=>localStorage.setItem(Store.key,JSON.stringify(s));
  Store.load=()=>{try{return JSON.parse(localStorage.getItem(Store.key)||localStorage.getItem('lm_core_rebuild_v15')||localStorage.getItem('lm_all_in_one_v1')||'null')}catch{return null}};
  Store.clear=()=>['lm_core_rebuild_v16_official_balance','lm_core_rebuild_v15','lm_all_in_one_v1'].forEach(k=>localStorage.removeItem(k));

  // 官方平衡：初始資源不送大量鑽石/卷軸；只給基本補給。
  Game.base=function(cls){
    const c=DB.classes[cls]||DB.classes.knight;
    return {version:'core_rebuild_v16_official_balance',cls:c.id,lv:1,exp:0,adena:3000,diamond:0,leaf:200,hp:1,mp:1,map:'talking',mon:null,
      stats:{...c.stats},inv:{'potion_red|0':{id:'potion_red',qty:30,enchant:0},'short_sword|0|start':{id:'short_sword',qty:1,enchant:0},'tshirt|0|start':{id:'tshirt',qty:1,enchant:0}},
      equip:{weapon:null,helmet:null,tshirt:null,armor:null,cloak:null,gloves:null,boots:null,amulet:null,belt:null,earring1:null,earring2:null,ring1:null,ring2:null,rune:null,seal:null,relic:null},
      cards:{},active:{transform:null,doll:null},learnedSkills:{},skillLevels:{},skillAwake:{},
      settings:{hpLimit:35,autoPotion:true,autoBuy:false,autoBoss:false,autoSell:false,autoSkills:[]},
      guild:{name:'',lv:1,donate:0,skill:0},daily:{dungeon:3,boss:1,tj:0,kills:0,diamondQuest:0},
      ach:{kills:0,boss:0,draw:0,craft:0,diamond:0,dailyDiamond:0},diamondLog:[],codex:{},growth:{mastery:0,magic:0,pvp:0},mail:[],last:Date.now()};
  };

  // 存檔遷移：移除異常數值，避免之前版本送太多鑽石/金幣造成失真。
  const oldEnsure=Game.ensure.bind(Game);
  Game.ensure=function(){
    oldEnsure();
    const s=this.s; if(!s) return;
    s.version='core_rebuild_v16_official_balance';
    s.diamond=Math.min(Math.max(0,finite(s.diamond,0)),999999);
    s.adena=Math.min(Math.max(0,finite(s.adena,0)),999999999);
    s.daily=Object.assign({dungeon:3,boss:1,tj:0,kills:0,diamondQuest:0},s.daily||{});
    s.daily.dungeon=Math.min(finite(s.daily.dungeon,3),3);
    s.daily.boss=Math.min(finite(s.daily.boss,1),1);
    s.daily.tj=0;
    s.settings=Object.assign({hpLimit:35,autoPotion:true,autoBuy:false,autoBoss:false,autoSell:false,autoSkills:[]},s.settings||{});
    if(!Array.isArray(s.settings.autoSkills))s.settings.autoSkills=[];
  };

  // 學技能：不再提供免費強制學習/一鍵全開；需等級、金幣與技能書。
  Game.skillCost=function(sk){ return Math.floor((sk.lv*sk.lv*35)+(R[sk.rank][1]*2500)); };
  Game.learnSkill=function(id){
    const sk=DB.skills[id]; if(!sk) return;
    if(this.s.learnedSkills[id]){ this.log('已學會：'+sk.name); return; }
    if(this.s.lv < sk.lv){ alert('等級不足，需要 Lv.'+sk.lv); return; }
    const bookKey=Object.keys(this.s.inv).find(k=>this.def(this.inv(k).id)?.type==='book' && this.def(this.inv(k).id).skill===id);
    const cost=this.skillCost(sk);
    if(!bookKey){ alert('缺少技能書：'+sk.name); return; }
    if(this.s.adena < cost){ alert('金幣不足，需要 '+this.fmt(cost)); return; }
    this.s.adena-=cost; this.rem(bookKey,1);
    this.s.learnedSkills[id]=true; this.s.skillLevels[id]=1;
    this.log('技能學習成功：'+sk.name,'green'); this.render();
  };
  Game.upgradeSkill=function(id){
    const sk=DB.skills[id]; if(!sk||!this.s.learnedSkills[id]) return;
    const lv=this.s.skillLevels[id]||1; if(lv>=5){ alert('技能已達目前模擬上限 Lv.5'); return; }
    const cost=this.skillCost(sk)*(lv+1)*3;
    if(this.s.adena<cost){ alert('金幣不足，需要 '+this.fmt(cost)); return; }
    this.s.adena-=cost; this.s.skillLevels[id]=lv+1; this.log('技能升級：'+sk.name+' Lv.'+(lv+1),'green'); this.render();
  };
  Game.awakeSkill=function(id){
    const sk=DB.skills[id]; if(!sk||!this.s.learnedSkills[id]) return;
    if(this.s.skillAwake[id]){ alert('已覺醒'); return; }
    const cost=this.skillCost(sk)*15;
    if((this.s.skillLevels[id]||1)<5){ alert('技能 Lv.5 後才能覺醒'); return; }
    if(this.s.adena<cost){ alert('金幣不足，需要 '+this.fmt(cost)); return; }
    this.s.adena-=cost; this.s.skillAwake[id]=true; this.log('技能覺醒：'+sk.name,'green'); this.render();
  };

  const oldAction=Game.action.bind(Game);
  Game.action=function(a,arg,b){
    if(a==='learnSkill') return this.learnSkill(arg);
    if(a==='forceLearnSkill'||a==='learnAllSkills'||a==='addSkillBooks'){ alert('官方平衡模式已移除免費/強制技能功能'); return; }
    if(a==='mail'){ alert('官方平衡模式不提供每日GM補償'); return; }
    if(a==='tj'){ alert('TJ活動需由活動期間開放，目前關閉'); return; }
    return oldAction(a,arg,b);
  };

  Game.viewSkills=function(){
    const mine=this.classSkills(), learned=mine.filter(sk=>this.s.learnedSkills[sk.id]).length;
    const rows=mine.map(sk=>{
      const is=!!this.s.learnedSkills[sk.id], lv=this.s.skillLevels[sk.id]||0, auto=this.s.settings.autoSkills.includes(sk.id), awake=!!this.s.skillAwake[sk.id];
      const stat=Object.entries(sk.stat||{}).map(([k,v])=>k+'+'+v).join('、')||'-', cost=this.skillCost(sk);
      const hasBook=Object.keys(this.s.inv).some(k=>this.def(this.inv(k).id)?.type==='book' && this.def(this.inv(k).id).skill===sk.id);
      const btn=is?`<span class="green">已學 Lv.${lv}${awake?'｜已覺醒':''}</span> <button data-act="upgradeSkill" data-arg="${sk.id}">升級</button> <button data-act="awakeSkill" data-arg="${sk.id}">覺醒</button> ${sk.type!=='passive'?`<button data-act="autoSkill" data-arg="${sk.id}" class="${auto?'gold':''}">${auto?'取消自動':'自動施放'}</button>`:''}`:`<button data-act="learnSkill" data-arg="${sk.id}" class="gold">學習</button>`;
      return `<div class="card item"><div class="row"><b class="r-${sk.rank}">${E(sk.name)}</b><span>${sk.typeName}｜${R[sk.rank][0]}｜需求Lv.${sk.lv}</span></div><div class="muted">技能書：${hasBook?'持有':'未持有'}｜學習費 ${this.fmt(cost)} 金幣｜MP ${sk.mp}｜威力 ${sk.power||'-'}｜加成：${E(stat)}</div><div class="muted">${E(sk.desc)}</div><div style="margin-top:8px">${btn}</div></div>`;
    }).join('');
    return `<h3 class="title">技能</h3><div class="card"><b class="gold">${this.cls().name}</b><br><span class="muted">已學 ${learned}/${mine.length}。本版已移除免費學習與一鍵全開；技能需等級、技能書與金幣。</span></div>${rows}`;
  };

  // 狩獵掉寶/鑽石：怪物不再大量掉鑽；鑽石主要來自成就/任務/活動少量模擬。
  Game.dropDiamond=function(m){
    const map=this.map(); let rate=0.0002,min=1,max=1,label='怪物稀有掉落';
    if(['dragon','toi','lastabad'].includes(map.id)){rate=0.0005;max=2;}
    if(['antharas','valakas'].includes(map.id)){rate=0.001;max=3;}
    if(m.boss){rate=0.01;min=1;max=10;label='Boss稀有掉落';}
    if(Math.random()<rate) this.gainDiamond(this.rand(min,max),label+'：'+m.name);
  };
  Game.checkDiamondQuest=function(){
    const k=this.s.daily.kills||0, got=this.s.daily.diamondQuest||0;
    const rewards=[[100,10],[500,30],[1000,60]];
    for(const [need,reward] of rewards){ if(k>=need && got<need){ this.s.daily.diamondQuest=need; this.s.ach.dailyDiamond=(this.s.ach.dailyDiamond||0)+reward; this.gainDiamond(reward,'每日狩獵任務 '+need+' 隻'); } }
  };
  Game.dungeon=function(id){
    const d=DB.dungeons.find(x=>x.id==id); if(!d) return;
    if(this.s.daily.dungeon<=0){ alert('今日副本次數不足'); return; }
    if(this.s.lv<d.lv){ alert('等級不足'); return; }
    if(this.s.diamond<d.cost){ alert('鑽石不足'); return; }
    this.s.daily.dungeon--; this.s.diamond-=d.cost; this.s.adena+=Math.floor(d.reward*0.45); this.s.exp+=this.need()*0.04;
    if(Math.random()<0.7) this.addItem('mat'+this.rand(0,8),this.rand(1,2));
    if(Math.random()<0.08) this.gainDiamond(this.rand(1,5),'副本稀有獎勵：'+d.name);
    this.log('完成副本：'+d.name,'green'); this.level(); this.render();
  };
  Game.boss=function(id){
    const b=DB.bosses.find(x=>x.id==id); if(!b) return;
    if(this.s.daily.boss<=0){ alert('世界王次數不足'); return; }
    if(this.s.lv<b.lv-15){ alert('等級不足'); return; }
    this.s.daily.boss--; this.s.adena+=b.lv*250; this.s.exp+=this.need()*0.05;
    if(Math.random()<0.45) this.addItem(pick(['scroll_weapon','scroll_armor','mat7','leaf_box']),1);
    if(Math.random()<0.18) this.gainDiamond(this.rand(5,30),'世界王參與獎勵：'+b.name);
    this.s.ach.boss++; this.log('參與討伐世界王：'+b.name,'green'); this.level(); this.render();
  };

  // 裝備強化：降低過度樂觀成功率，祝福卷只作為更好成功率，不保證一路上去。
  Game.enchant=function(k){
    k=this.split(k); const it=this.inv(k), d=this.def(it?.id); if(!it||!d) return;
    const target=d.type==='weapon'?'weapon':(['ring','earring','amulet','belt','rune','seal','relic'].includes(d.type)?'accessory':'armor');
    const sk=Object.keys(this.s.inv).find(x=>this.def(this.inv(x).id)?.type==='scroll'&&this.def(this.inv(x).id).target===target);
    if(!sk){ alert('沒有對應卷軸'); return; }
    const scroll=this.def(this.inv(sk).id); this.rem(sk,1);
    const safe=d.safe||0, over=Math.max(0,(it.enchant||0)-safe+1);
    let rate=(it.enchant||0)<safe?1:Math.max(0.03,0.42-over*0.075);
    if(scroll.id&&scroll.id.includes('bless')) rate=Math.min(0.9,rate+0.08);
    if(Math.random()<rate){ it.enchant++; this.log(d.name+' 強化成功 +'+it.enchant,'green'); }
    else { this.log(d.name+' 強化失敗，裝備消失','red'); this.rem(k,99); }
    this.render();
  };

  // 抽卡機率：降低神話/傳說產出，不再太容易。
  Game.draw=function(kind,times=1){
    const cost=kind==='transform'?120:100, got=[];
    if(this.s.diamond<cost*times){ alert('鑽石不足'); return; }
    this.s.diamond-=cost*times;
    for(let i=0;i<times;i++){
      const r=Math.random(); let rank=r>0.9999?'M':r>0.999?'L':r>0.985?'SSR':r>0.90?'SR':r>0.55?'R':'N';
      const pool=Object.values(DB.cards).filter(c=>c.kind===kind&&c.rank===rank);
      const c=pick(pool.length?pool:Object.values(DB.cards).filter(c=>c.kind===kind));
      this.s.cards[c.id]=(this.s.cards[c.id]||0)+1; got.push(`<span class="r-${c.rank}">${c.name}</span>`);
    }
    this.s.ach.draw+=times; this.log('抽卡結果：'+got.join('、'),'green'); this.render();
  };
  Game.combine=function(kind,rank){
    const ids=Object.keys(this.s.cards).filter(id=>this.card(id)?.kind===kind&&this.card(id)?.rank===rank&&this.s.cards[id]>0);
    let total=ids.reduce((a,id)=>a+this.s.cards[id],0); if(total<4){ alert('需要4張同階卡'); return; }
    let n=4; for(const id of ids){ while(this.s.cards[id]>0&&n>0){ this.s.cards[id]--; n--; } }
    const order=['N','R','SR','SSR','L','M'], next=order[Math.min(order.length-1,order.indexOf(rank)+1)];
    const chance={N:.55,R:.35,SR:.18,SSR:.08,L:.02}[rank]||0;
    const final=Math.random()<chance?next:rank;
    const pool=Object.values(DB.cards).filter(c=>c.kind===kind&&c.rank===final); const c=pick(pool);
    this.s.cards[c.id]=(this.s.cards[c.id]||0)+1; this.log(`合成${final===next?'成功':'失敗'}：${c.name}`,'green'); this.render();
  };

  Game.viewDash=function(){
    const st=this.total();
    return `<h3 class="title">總覽</h3><div class="grid cards"><div class="card"><b>戰力</b><div style="font-size:34px" class="gold">${this.fmt(st.dmg*12+this.s.lv*30+(10-st.ac)*8+st.dr*20)}</div><span class="muted">由等級、裝備、卡片、收藏、血盟與技能計算</span></div><div class="card"><b>今日資源</b><p>副本 ${this.s.daily.dungeon}｜世界王 ${this.s.daily.boss}</p><span class="muted">TJ/GM補償已關閉，避免破壞經濟平衡。</span></div><div class="card"><b>V16修正</b><p class="muted">初始資源、鑽石掉落、抽卡機率、強化機率、技能學習、副本與Boss獎勵已重新平衡。所有模組改由同一套核心資料庫計算。</p></div></div>`;
  };
  Game.viewHunt=function(){
    return `<h3 class="title">狩獵設定</h3><div class="card"><b class="cyan">鑽石經濟</b><br>本版改為接近官方感的稀有掉落：一般怪極低機率 1鑽，高階/Boss 小幅提高；每日任務提供少量鑽石，不再大量灑鑽。</div>${DB.maps.map(m=>`<div class="card item"><b>${m.name}</b> Lv.${m.min}-${m.max}<br><span class="muted">怪物：${m.mons.join('、')}｜掉落：${m.drops.map(id=>this.def(id)?.name||id).join('、')}</span></div>`).join('')}`;
  };
  Game.viewShop=function(){
    const goods=[['leaf_box',120],['scroll_weapon',80],['scroll_armor',50],['potion_clear',10]];
    return `<h3 class="title">商城 / 補給</h3><p class="muted">價格改為分項，不再所有商品100鑽。</p>`+goods.map(([id,cost])=>`<div class="item row"><span>${this.def(id).name}</span><button data-act="buy" data-arg="${id}|${cost}">購買 ${cost}鑽</button></div>`).join('');
  };
  const oldBuyAction=Game.action.bind(Game);
  Game.action=function(a,arg,b){
    if(a==='buy' && String(arg).includes('|')){ const [id,costRaw]=String(arg).split('|'); const cost=+costRaw||0; if(this.s.diamond<cost){alert('鑽石不足');return;} this.s.diamond-=cost; this.addItem(id,1); this.render(); return; }
    if(a==='learnSkill') return this.learnSkill(arg);
    if(a==='forceLearnSkill'||a==='learnAllSkills'||a==='addSkillBooks'){ alert('官方平衡模式已移除免費/強制技能功能'); return; }
    if(a==='mail'){ alert('官方平衡模式不提供每日GM補償'); return; }
    if(a==='tj'){ alert('TJ活動需由活動期間開放，目前關閉'); return; }
    return oldBuyAction(a,arg,b);
  };

  Game.viewPvp=function(){ return `<h3 class="title">競技場 / 排行榜</h3><button data-act="pvp" class="gold">挑戰競技場</button><div class="grid cards" style="margin-top:10px">${['肯恩','絲莉安','甘特','卡士柏','伊娃'].map((n,i)=>`<div class="card">#${i+1} ${n}<br><span class="muted">戰力 ${this.fmt(90000-i*8000+this.rand(0,2000))}</span></div>`).join('')}</div>`; };
  Game.viewAudit=function(){
    const items=Object.values(DB.item), miss=DB.maps.flatMap(m=>m.drops.filter(id=>!DB.item[id]).map(id=>m.name+':'+id));
    const cheats=['forceLearnSkill','learnAllSkills','addSkillBooks','mail','tj'];
    return `<h3 class="title">完整度檢查</h3><div class="grid cards"><div class="card"><b>職業</b><div class="big gold">${Object.keys(DB.classes).length}</div></div><div class="card"><b>地圖</b><div class="big gold">${DB.maps.length}</div></div><div class="card"><b>怪物</b><div class="big gold">${new Set(DB.maps.flatMap(m=>m.mons)).size}</div></div><div class="card"><b>裝備/道具</b><div class="big gold">${items.length}</div></div><div class="card"><b>變身</b><div class="big gold">${Object.values(DB.cards).filter(c=>c.kind==='transform').length}</div></div><div class="card"><b>魔法娃娃</b><div class="big gold">${Object.values(DB.cards).filter(c=>c.kind==='doll').length}</div></div><div class="card"><b>技能</b><div class="big gold">${Object.keys(DB.skills).length}</div><span class="muted">技能書 ${items.filter(x=>x.type==='book').length}</span></div></div><div class="card"><b>${miss.length?'資料關聯仍有缺漏':'資料關聯檢查通過'}</b><br><span class="muted">掉落表缺失：${miss.length?miss.join('、'):'無'}<br>已移除/封鎖不合理功能：${cheats.join('、')}</span></div>`;
  };
})();


/* === V17 CONTENT EXPANSION / CORE DATA REBUILD ===
   目標：不再只用少量樣本資料；補足地圖、怪物、裝備、變身、娃娃、副本、Boss、收藏資料量，
   並讓完整度檢查可以反映新版資料庫。此為單機模擬資料庫，名稱/分類以天堂M風格整理。
*/
(function(){
  const rankValue = r => (R[r] ? R[r][1] : 1);
  const existsItem = id => !!DB.item[id];
  const existsCard = id => !!DB.cards[id];
  function putItem(id,o){ if(!DB.item[id]) addItem(id,Object.assign({id,type:'material',rank:'N',price:100},o)); }
  function putCard(id,name,rank,stat,kind){ if(!DB.cards[id]) DB.cards[id]={id,name,rank,stat,kind}; }
  function putMap(id,name,min,max,mons,drops,zone){ const i=DB.maps.findIndex(m=>m.id===id); const row={id,name,min,max,mons,drops,zone:zone||'field'}; if(i>=0) DB.maps[i]=Object.assign(DB.maps[i],row); else DB.maps.push(row); }
  function putDungeon(id,name,lv,cost,reward,type){ if(!DB.dungeons.find(d=>d.id===id)) DB.dungeons.push({id,name,lv,cost,reward,type:type||'daily'}); }
  function putBoss(id,name,lv,hp,zone){ if(!DB.bosses.find(b=>b.id===id)) DB.bosses.push({id,name,lv,hp,zone:zone||'world'}); }

  const weaponTypes={sword:'劍',twohand:'雙手劍',dagger:'短劍',bow:'弓',staff:'魔杖',dualblade:'雙刀',claw:'鋼爪',chain_sword:'鎖鏈劍',axe:'斧',spear:'槍',scythe:'鐮刀',kiringku:'奇古獸'};
  const weaponBases=['古老','精靈','黑暗','銀光','水晶','獵人','武官','神官','瑟魯基','破滅','雷雨','月光','惡魔王','克特','死亡騎士','冰之女王','巴列斯','巨蟻女皇','吸血鬼','巫妖','木乃伊王','騎士范德','反王肯恩','海露拜','地龍','水龍','火龍','風龍','吉爾塔斯','奧丁'];
  let n=0;
  Object.keys(weaponTypes).forEach((t,ti)=>{
    weaponBases.forEach((base,bi)=>{
      const rank=bi<5?'N':bi<10?'R':bi<16?'SR':bi<22?'SSR':bi<28?'L':'M';
      const dmg=6+ti*2+bi*2+rankValue(rank)*4;
      putItem(`v17_w_${t}_${bi}`,{name:`${base}${weaponTypes[t]}`,type:'weapon',weapon:t,dmg,rank,safe:6,price:(2500+bi*900+ti*600)*rankValue(rank)});
      n++;
    });
  });

  const armorSlots=[['helmet','頭盔'],['tshirt','內衣'],['armor','盔甲'],['cloak','斗篷'],['gloves','手套'],['boots','長靴']];
  const armorBases=['皮革','骨製','妖魔','精靈','鋼鐵','水晶','魔法','武官','神官','黑暗','力量','敏捷','智力','抗魔','古代','惡魔王','死亡騎士','巨蟻女皇','吸血鬼','巫妖','木乃伊王','反王','地龍','水龍','火龍','風龍','神話守護'];
  armorSlots.forEach(([slot,label],si)=>armorBases.forEach((base,bi)=>{
    const rank=bi<4?'N':bi<8?'R':bi<14?'SR':bi<21?'SSR':bi<26?'L':'M';
    const stat={}; if(base.includes('力量')) stat.str=2; if(base.includes('敏捷')) stat.dex=2; if(base.includes('智力')) stat.int=2; if(base.includes('抗魔')||base.includes('神官')) stat.mr=10+bi; if(['地龍','水龍','火龍','風龍','神話守護'].includes(base)){stat.dr=rankValue(rank)*2; stat.hp=rankValue(rank)*80;} if(base==='火龍') stat.dmg=8; if(base==='風龍') stat.spd=8;
    putItem(`v17_a_${slot}_${bi}`,{name:`${base}${label}`,type:slot,ac:-(1+si+Math.floor(bi/2)+rankValue(rank)),rank,stat,safe:slot==='tshirt'?4:4,price:(1800+bi*750+si*300)*rankValue(rank)});
  }));

  const accSlots=[['amulet','項鍊'],['ring','戒指'],['earring','耳環'],['belt','腰帶'],['rune','符石'],['seal','印章'],['relic','聖物']];
  const accBases=['守護','勇氣','智慧','敏捷','力量','精神','抗魔','體力','魔力','暗黑','深淵','光明','英雄','傳說','龍之','地龍','水龍','火龍','風龍','神話'];
  accSlots.forEach(([slot,label],si)=>accBases.forEach((base,bi)=>{
    const rank=bi<3?'N':bi<7?'R':bi<12?'SR':bi<15?'SSR':bi<19?'L':'M';
    const stat={}; if(base.includes('力量')) stat.str=2; if(base.includes('敏捷')) stat.dex=2; if(base.includes('智慧')) stat.int=2; if(base.includes('精神')) stat.wis=2; if(base.includes('守護')) stat.dr=1+rankValue(rank); if(base.includes('勇氣')) stat.dmg=2+rankValue(rank); if(base.includes('抗魔')) stat.mr=10+rankValue(rank)*5; if(base.includes('體力')) stat.hp=80+rankValue(rank)*60; if(base.includes('魔力')) stat.mp=80+rankValue(rank)*50; if(['龍之','地龍','水龍','火龍','風龍','神話'].some(x=>base.includes(x))){stat.dmg=rankValue(rank)*3; stat.dr=rankValue(rank); stat.hp=rankValue(rank)*70;}
    putItem(`v17_acc_${slot}_${bi}`,{name:`${base}${label}`,type:slot,rank,stat,safe:0,price:(3000+bi*1200+si*500)*rankValue(rank)});
  }));

  ['武器魔法卷軸','盔甲魔法卷軸','受祝福的武器魔法卷軸','受祝福的盔甲魔法卷軸','詛咒的武器魔法卷軸','詛咒的盔甲魔法卷軸','飾品強化卷軸','受祝福的飾品強化卷軸'].forEach((name,i)=>putItem(`v17_scroll_${i}`,{name,type:'scroll',target:i%2===0?'weapon':'armor',rank:i<2?'N':i<6?'R':'SR',price:30000+i*30000}));
  ['皮革','寶石','高級寶石','金屬塊','高級金屬塊','布','高級布','魔法結晶體','龍之心','龍之血痕','哈爾巴斯的執念','名譽金幣','變身製作硬幣','魔法娃娃製作硬幣','神話製作秘笈','英雄製作秘笈','傳說製作秘笈','封印的稀有防具製作秘笈','封印的英雄武器製作秘笈','祝福賦予卷軸'].forEach((name,i)=>putItem(`v17_mat_${i}`,{name,type:'material',rank:i<7?'N':i<12?'R':i<16?'SR':i<19?'SSR':'L',price:300+i*900}));

  const transformNames=['史萊姆','哥布林','妖魔','骷髏','狼人','萊肯','食屍鬼','長者','黑騎士','黑暗妖精','弓箭手','法師','騎士','白金騎士','黃金騎士','死亡騎士','黑暗騎士','克特','巴風特','巴列斯','冰之女王','賽尼斯','巫妖','木乃伊王','吸血鬼','反王肯恩','絲莉安','甘特','宙斯','奧丁','吉爾塔斯','安塔瑞斯','法利昂','巴拉卡斯','林德拜爾','格蘭肯','殷海薩'];
  transformNames.forEach((name,i)=>{const rank=i<8?'N':i<14?'R':i<21?'SR':i<27?'SSR':i<34?'L':'M'; putCard(`v17_t_${i}`,name,rank,{spd:2+i,dmg:Math.floor(i/3)+rankValue(rank),hit:Math.floor(i/4),str:i%3===0?rankValue(rank):0,dex:i%3===1?rankValue(rank):0,int:i%3===2?rankValue(rank):0,dr:i>24?rankValue(rank):0},'transform');});
  const dollNames=['小妖精','肥肥','史巴托','雪人','長者','亞力安','石頭高崙','蛇女','思克巴','魔法娃娃：騎士','魔法娃娃：妖精','魔法娃娃：法師','魔法娃娃：黑暗妖精','魔法娃娃：死亡騎士','魔法娃娃：巴風特','魔法娃娃：冰之女王','魔法娃娃：巫妖','魔法娃娃：吸血鬼','魔法娃娃：木乃伊王','魔法娃娃：反王肯恩','魔法娃娃：安塔瑞斯','魔法娃娃：法利昂','魔法娃娃：巴拉卡斯','魔法娃娃：林德拜爾','魔法娃娃：奧丁','魔法娃娃：吉爾塔斯'];
  dollNames.forEach((name,i)=>{const rank=i<5?'N':i<10?'R':i<15?'SR':i<20?'SSR':i<24?'L':'M'; putCard(`v17_d_${i}`,name,rank,{hp:30+i*20,mp:i*12,dmg:Math.floor(i/3)+rankValue(rank),dr:i>12?rankValue(rank):0,mr:i>8?i*2:0},'doll');});

  const zones=[
    ['mlc','說話之島地監',10,25,['洞穴蝙蝠','洞穴蜘蛛','妖魔巡守','骷髏槍兵','黑騎士偵查兵'],['v17_w_dagger_2','v17_a_helmet_2','potion_red','v17_mat_0']],
    ['windawood','風木沙漠',20,40,['蠍子','沙漠蜥蜴','沙漠花','沙蟲','巨大蠍子'],['v17_w_bow_3','v17_a_boots_3','v17_mat_1','scroll_armor']],
    ['silver','銀騎士村周邊',25,45,['野豬','萊肯','黑騎士','食人妖精','巡邏兵'],['v17_w_sword_4','v17_a_armor_4','v17_acc_belt_2','scroll_weapon']],
    ['elf_forest','妖精森林',28,48,['森林蜘蛛','精靈巡守','樹精','潘','森林守護者'],['v17_w_bow_5','v17_a_cloak_5','v17_acc_amulet_3','v17_mat_5']],
    ['heine','海音沼澤',35,58,['鱷魚','蜥蜴人','海音守衛','水精靈','沼澤怪'],['v17_w_spear_6','v17_a_boots_6','v17_acc_ring_4','v17_mat_6']],
    ['eva','伊娃王國',45,68,['水龍侍女','美人魚','深海蟹人','海底守衛','伊娃祭司'],['v17_w_staff_8','v17_a_armor_8','v17_acc_earring_6','v17_mat_8']],
    ['dvc1','龍之谷地監1F',50,72,['骨龍','飛龍','哈維','龍人戰士','龍人法師'],['dragon_slayer','v17_a_helmet_12','v17_acc_ring_8','mat1']],
    ['dvc2','龍之谷地監2F',58,80,['巨大飛龍','地龍守衛','龍之祭司','龍之騎士','龍之術士'],['v17_w_twohand_14','dragon_armor','v17_acc_relic_12','v17_mat_10']],
    ['toi1','傲慢之塔1F',60,78,['傲慢殭屍','傲慢骷髏','傲慢食屍鬼','傲慢幽魂','傲慢守衛'],['death_blade','ancient_armor','dark_earring','mat2']],
    ['toi2','傲慢之塔2F',65,82,['梅杜莎','蛇女','奇美拉','傲慢魔女','傲慢祭司'],['v17_w_staff_13','v17_a_cloak_13','v17_acc_amulet_10','v17_mat_11']],
    ['toi3','傲慢之塔3F',70,88,['吸血鬼僕從','血腥騎士','黑暗祭司','傲慢法師','吸血鬼'],['v17_w_sword_18','v17_a_armor_18','v17_acc_belt_18','v17_mat_12']],
    ['toi4','傲慢之塔4F',75,92,['殭屍王','木乃伊守衛','死亡騎士親衛','巫妖僕從','木乃伊王'],['v17_w_twohand_20','v17_a_helmet_20','v17_acc_ring_13','v17_mat_13']],
    ['lastabad2','拉斯塔巴德中央廣場',82,97,['黑妖將軍','黑妖法師','暗殺隊長','親衛隊長','拉斯塔巴德君王'],['roaring_dual','mortal_chain','ogre_belt','v17_mat_14']],
    ['pirate','海賊島',45,70,['海賊骷髏','海賊槍兵','深海章魚','海賊王親衛','船長'],['v17_w_dagger_10','v17_a_cloak_10','v17_acc_earring_9','v17_mat_7']],
    ['oman','奧曼營地',78,95,['奧曼戰士','奧曼弓手','奧曼祭司','奧曼隊長','奧曼大將'],['v17_w_axe_17','v17_a_gloves_17','v17_acc_seal_14','v17_mat_15']],
    ['giran_prison','奇岩監獄',55,84,['囚犯','瘋狂囚犯','看守者','黑暗看守','監獄長'],['mailbreaker','v17_a_armor_11','v17_acc_belt_11','scroll_weapon']],
    ['forgotten','遺忘之島',80,99,['古代守護者','遺忘巨人','巨大飛龍','古代龍人','遺忘之王'],['v17_w_spear_22','v17_a_armor_22','v17_acc_relic_16','v17_mat_16']],
    ['hell','地獄',85,99,['地獄犬','惡魔','火焰守衛','巴列斯親衛','地獄君主'],['v17_w_staff_24','v17_a_cloak_24','v17_acc_seal_17','v17_mat_18']],
    ['giran_castle','奇岩城內城',75,95,['城堡守衛','親衛騎士','城堡法師','奇岩大將','城主幻影'],['v17_w_sword_21','v17_a_helmet_21','v17_acc_amulet_14','v17_mat_14']],
    ['event_training','修練地活動',1,99,['修練稻草人','修練妖魔','修練騎士','修練法師','修練首領'],['potion_red','potion_orange','v17_mat_0','leaf_box']]
  ];
  zones.forEach(z=>putMap(...z));

  const extraMapNames=['古魯丁村外圍','肯特城周邊','燃柳村周邊','威頓村周邊','歐瑞雪原','象牙塔外圍','亞丁大陸北部','亞丁大陸南部','鏡子森林','眠龍洞穴','黃昏山脈','巨人峽谷','暗影神殿','古代精靈墓穴','封印之地','裂痕邊境','異界戰場','夢幻樂園','血盟訓練場','跨服裂痕'];
  extraMapNames.forEach((name,i)=>{
    const id='v17_zone_'+i, min=15+i*4, max=Math.min(99,min+25);
    const mons=Array.from({length:5},(_,j)=>`${name}怪物${j+1}`);
    const drops=[`v17_w_${Object.keys(weaponTypes)[i%12]}_${(i+jitter(i,3))%weaponBases.length}`,`v17_a_${armorSlots[i%armorSlots.length][0]}_${(i*2)%armorBases.length}`,`v17_acc_${accSlots[i%accSlots.length][0]}_${(i*3)%accBases.length}`,`v17_mat_${i%20}`];
    putMap(id,name,min,max,mons,drops,'field');
  });
  function jitter(i,m){return (i*7+m)%11;}

  ['試煉之塔','歐林的日記','夢幻之島火區','夢幻之島水區','夢幻之島風區','夢幻之島地區','古代精靈墓穴','龍之鑽石副本高級','傲慢之塔時間補充','血盟突襲','世界副本：遺忘之島','世界副本：傲慢與信念','跨服競技場','支配之塔','惡夢的島','特殊副本：拋棄之地','特殊副本：影子神殿','特殊副本：海音地監'].forEach((name,i)=>putDungeon('v17_dg_'+i,name,20+i*4,i<6?0:(20+i*5),8000+i*2500,i<10?'daily':'special'));
  ['飛龍王','巨大骷髏','巨大守護螞蟻','賽尼斯','克特','黑長者','巴列斯','巨蟻女皇','不死鳥','惡魔','冰之女王','吸血鬼','騎士范德','黑暗大法師','烏格奴斯','鐮刀死神','支配者吉爾塔斯','恐怖安塔瑞斯','憤怒巴拉卡斯','疾風林德拜爾','深海法利昂'].forEach((name,i)=>putBoss('v17_boss_'+i,name,35+i*3,2500+i*2200,i>15?'dragon':'world'));

  const codexSources=[
    ['初級武器收藏',['v17_w_sword_1','v17_w_dagger_1'],{dmg:1}],['精靈武裝收藏',['v17_w_bow_3','v17_a_cloak_3','v17_acc_amulet_3'],{dex:1,hit:1}],['黑暗戰鬥收藏',['v17_w_dualblade_8','v17_w_claw_8','v17_a_armor_9'],{dmg:3}],['抗魔裝備收藏',['v17_a_cloak_13','v17_acc_ring_6','v17_acc_earring_6'],{mr:15}],['傲慢之塔收藏',['v17_w_staff_13','v17_a_helmet_20','v17_acc_ring_13'],{dmg:5,dr:2}],['四龍守護收藏',['v17_a_armor_22','v17_a_armor_23','v17_a_armor_24','v17_a_armor_25'],{hp:300,dr:5}],['神話武器收藏',['v17_w_sword_29','v17_w_bow_29','v17_w_staff_29'],{dmg:15,hit:8}],['英雄變身收藏',['v17_t_21','v17_t_22','v17_t_23'],{dmg:5,hit:4}],['傳說變身收藏',['v17_t_27','v17_t_28','v17_t_29'],{dmg:10,spd:8}],['神話娃娃收藏',['v17_d_24','v17_d_25'],{dr:8,hp:500}]
  ];
  codexSources.forEach(c=>{ if(!DB.codex.find(x=>x[0]===c[0])) DB.codex.push(c); });

  // 讓「市場」不只顯示前25筆，改成依分類顯示更多內容。
  if(window.Game){
    const oldEnsure=Game.ensure;
    Game.ensure=function(){ oldEnsure.call(this); this.s.version='core_rebuild_v17_expanded'; if(!this.s.settings) this.s.settings={}; if(!Array.isArray(this.s.settings.autoSkills)) this.s.settings.autoSkills=[]; };
    Game.viewMarket=function(){
      const groups=[['武器','weapon'],['防具','armor'],['飾品/符石/聖物','accessory'],['材料','material'],['卷軸','scroll']];
      let html='<h3 class="title">交易所 / 道具圖鑑</h3><p class="muted">V17 已擴充核心資料庫，交易所改用分類方式瀏覽。</p>';
      groups.forEach(([title,type])=>{
        let list=Object.values(DB.item).filter(d=> type==='armor'?['helmet','tshirt','armor','cloak','gloves','boots'].includes(d.type): type==='accessory'?['amulet','ring','earring','belt','rune','seal','relic'].includes(d.type):d.type===type).slice(0,80);
        html+=`<div class="card"><b class="gold">${title}</b><div class="grid cards" style="margin-top:8px">`+list.map(d=>`<div class="mini"><span class="r-${d.rank}">${d.name}</span><br><span class="muted">${d.type}｜${(d.price||0).toLocaleString()}金幣</span></div>`).join('')+'</div></div>';
      });
      return html;
    };
    Game.viewAudit=function(){
      const items=Object.values(DB.item), transforms=Object.values(DB.cards).filter(c=>c.kind==='transform'), dolls=Object.values(DB.cards).filter(c=>c.kind==='doll'), monsters=new Set(DB.maps.flatMap(m=>m.mons));
      const miss=DB.maps.flatMap(m=>m.drops.filter(id=>!DB.item[id]).map(id=>m.name+':'+id));
      const byType=t=>items.filter(i=>t.includes(i.type)).length;
      return `<h3 class="title">完整度檢查｜V17 擴充版</h3><div class="grid cards"><div class="card"><b>職業</b><div class="big gold">${Object.keys(DB.classes).length}</div></div><div class="card"><b>地圖</b><div class="big gold">${DB.maps.length}</div></div><div class="card"><b>怪物</b><div class="big gold">${monsters.size}</div></div><div class="card"><b>裝備/道具</b><div class="big gold">${items.length}</div><span class="muted">武器 ${byType(['weapon'])}｜防具 ${byType(['helmet','tshirt','armor','cloak','gloves','boots'])}｜飾品 ${byType(['amulet','ring','earring','belt','rune','seal','relic'])}</span></div><div class="card"><b>變身</b><div class="big gold">${transforms.length}</div></div><div class="card"><b>魔法娃娃</b><div class="big gold">${dolls.length}</div></div><div class="card"><b>技能</b><div class="big gold">${Object.keys(DB.skills).length}</div><span class="muted">技能書 ${items.filter(x=>x.type==='book').length}</span></div><div class="card"><b>副本</b><div class="big gold">${DB.dungeons.length}</div></div><div class="card"><b>Boss</b><div class="big gold">${DB.bosses.length}</div></div><div class="card"><b>收藏</b><div class="big gold">${DB.codex.length}</div></div></div><div class="card"><b>${miss.length?'資料關聯仍有缺漏':'資料關聯檢查通過'}</b><br><span class="muted">掉落表缺失：${miss.length?miss.join('、'):'無'}<br>V17：補齊大量地圖、怪物、武器、防具、飾品、變身、娃娃、Boss、副本、收藏，並維持官方平衡核心，不再開放免費GM/TJ破壞經濟。</span></div>`;
    };
    Game.viewDash=function(){
      const st=this.total();
      return `<h3 class="title">總覽</h3><div class="grid cards"><div class="card"><b>戰力</b><div style="font-size:34px" class="gold">${this.fmt(st.dmg*12+this.s.lv*30+(10-st.ac)*8+st.dr*20)}</div><span class="muted">由等級、裝備、卡片、收藏、血盟與技能計算。</span></div><div class="card"><b>V17內容擴充</b><p class="muted">已將少量樣本資料改成大型核心資料庫：地圖 ${DB.maps.length}、怪物 ${new Set(DB.maps.flatMap(m=>m.mons)).size}、道具 ${Object.keys(DB.item).length}、卡片 ${Object.keys(DB.cards).length}、技能 ${Object.keys(DB.skills).length}。</p></div><div class="card"><b>今日資源</b><p>副本 ${this.s.daily.dungeon}｜世界王 ${this.s.daily.boss}</p><span class="muted">保持官方感平衡，取消免費補償按鈕。</span></div></div>`;
    };
    Game.viewCards=function(){
      const groups=[['變身','transform'],['魔法娃娃','doll']];
      return '<h3 class="title">變身 / 魔法娃娃圖鑑</h3>'+groups.map(([title,kind])=>`<div class="card"><b class="gold">${title}</b>`+Object.values(DB.cards).filter(c=>c.kind===kind).map(c=>`<div class="item row"><span class="r-${c.rank}">${c.name} ×${this.s.cards[c.id]||0}</span><span>${this.s.cards[c.id]?`<button data-act="active" data-arg="${c.id}">啟用</button>`:''}</span></div>`).join('')+'</div>').join('');
    };
  }
})();


/* === V18 MATERIAL CRAFTING REBUILD ===
   製作材料詳細化：不再用「通用材料數」製作，改為各裝備配方需要指定材料。
   怪物掉落：每張地圖會追加對應區域材料、幣、秘笈碎片掉落。 */
(function(){
  const esc=s=>String(s??'').replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
  const rv=r=>(R[r]&&R[r][1])||1;
  const mat=(id,name,rank,price,group,desc)=>{ if(!DB.item[id]) addItem(id,{name,type:'material',rank,price,group,desc}); else Object.assign(DB.item[id],{type:'material',rank,price,group,desc}); };

  const mats=[
    ['m18_iron_ore','鐵礦石','N',120,'金屬','基礎武器、防具共用材料'],['m18_iron_ingot','鐵錠','R',450,'金屬','中階金屬材料'],['m18_steel_ingot','鋼鐵錠','SR',1500,'金屬','高階武器與重甲材料'],['m18_oriharucon','奧里哈魯根','SSR',6500,'金屬','英雄級武器材料'],['m18_mithril','米索莉金屬','SSR',7200,'金屬','魔法武器與輕甲材料'],['m18_dragon_metal','龍之金屬','L',26000,'金屬','傳說與神話裝備核心金屬'],
    ['m18_leather','皮革','N',100,'皮革','基礎防具材料'],['m18_hard_leather','硬皮革','R',420,'皮革','中階皮甲材料'],['m18_troll_leather','食人妖精皮革','SR',1350,'皮革','高階皮甲材料'],['m18_dragon_leather','龍皮革','SSR',6000,'皮革','英雄級防具材料'],['m18_ancient_leather','古代皮革','L',22000,'皮革','傳說防具材料'],
    ['m18_cloth','布','N',90,'布料','法袍、斗篷基礎材料'],['m18_silk','絲綢','R',380,'布料','中階布料'],['m18_magic_cloth','魔法布','SR',1250,'布料','法袍、魔法裝備材料'],['m18_blessed_cloth','祝福布','SSR',5400,'布料','英雄級布料'],['m18_ancient_silk','古代絲綢','L',21000,'布料','傳說級布料'],
    ['m18_gem','寶石','N',160,'寶石','飾品基礎材料'],['m18_high_gem','高級寶石','R',520,'寶石','中階飾品材料'],['m18_magic_gem','魔法寶石','SR',1800,'寶石','魔法飾品材料'],['m18_dragon_gem','龍之寶石','SSR',7800,'寶石','英雄級飾品材料'],['m18_ancient_gem','古代寶石','L',28000,'寶石','傳說級飾品材料'],
    ['m18_powder','祝福粉末','R',650,'魔法材料','強化與製作輔助材料'],['m18_crystal','魔法結晶體','SR',2100,'魔法材料','技能、魔法裝備材料'],['m18_soul','靈魂結晶','SR',2600,'魔法材料','死神、黑妖、幻術系材料'],['m18_dark_soul','黑暗靈魂石','SSR',8200,'魔法材料','黑暗裝備核心材料'],['m18_holy_water','聖水','R',700,'魔法材料','神聖裝備材料'],['m18_holy_crystal','聖光結晶','SSR',8500,'魔法材料','神聖劍士、聖物材料'],
    ['m18_dragon_scale_earth','地龍鱗','SSR',9000,'四龍材料','安塔瑞斯系列材料'],['m18_dragon_scale_water','水龍鱗','SSR',9000,'四龍材料','法利昂系列材料'],['m18_dragon_scale_fire','火龍鱗','SSR',9000,'四龍材料','巴拉卡斯系列材料'],['m18_dragon_scale_wind','風龍鱗','SSR',9000,'四龍材料','林德拜爾系列材料'],['m18_dragon_heart','龍之心','L',45000,'四龍材料','傳說/神話核心材料'],['m18_dragon_blood','龍之血痕','L',38000,'四龍材料','傳說/神話輔助材料'],
    ['m18_weapon_frag','武器碎片','N',140,'碎片','各類武器分解與掉落材料'],['m18_armor_frag','防具碎片','N',130,'碎片','各類防具分解與掉落材料'],['m18_acc_frag','飾品碎片','N',150,'碎片','各類飾品分解與掉落材料'],['m18_skill_page','殘破技能書頁','R',750,'書頁','技能書製作材料'],['m18_rare_scroll_piece','稀有製作秘笈碎片','R',1200,'秘笈','稀有製作碎片'],['m18_hero_scroll_piece','英雄製作秘笈碎片','SR',4200,'秘笈','英雄製作碎片'],['m18_legend_scroll_piece','傳說製作秘笈碎片','SSR',16000,'秘笈','傳說製作碎片'],['m18_myth_scroll_piece','神話製作秘笈碎片','L',65000,'秘笈','神話製作碎片'],
    ['m18_adena_pouch','金幣袋','N',200,'貨幣','怪物可掉落金幣補給'],['m18_honor_coin','名譽金幣','R',900,'貨幣','血盟與技能相關材料'],['m18_transform_coin','變身製作硬幣','R',950,'貨幣','變身卡製作材料'],['m18_doll_coin','魔法娃娃製作硬幣','R',950,'貨幣','娃娃卡製作材料'],['m18_relic_piece','聖物碎片','SR',3000,'聖物','聖物、符石、印章材料']
  ];
  mats.forEach(x=>mat(...x));

  const commonLow=['m18_iron_ore','m18_leather','m18_cloth','m18_gem','m18_weapon_frag','m18_armor_frag','m18_acc_frag'];
  const commonMid=['m18_iron_ingot','m18_hard_leather','m18_silk','m18_high_gem','m18_powder','m18_holy_water','m18_skill_page'];
  const commonHigh=['m18_steel_ingot','m18_troll_leather','m18_magic_cloth','m18_magic_gem','m18_crystal','m18_soul','m18_hero_scroll_piece'];
  const commonHero=['m18_oriharucon','m18_mithril','m18_dragon_leather','m18_blessed_cloth','m18_dragon_gem','m18_dark_soul','m18_holy_crystal','m18_legend_scroll_piece'];
  const dragonMats=['m18_dragon_scale_earth','m18_dragon_scale_water','m18_dragon_scale_fire','m18_dragon_scale_wind','m18_dragon_heart','m18_dragon_blood'];

  function addDropsToMap(m, arr){
    m.materialDrops=m.materialDrops||[];
    arr.forEach(id=>{ if(DB.item[id]&&!m.drops.includes(id)) m.drops.push(id); if(DB.item[id]&&!m.materialDrops.includes(id)) m.materialDrops.push(id); });
  }
  DB.maps.forEach(m=>{
    const name=m.name||'', id=m.id||'';
    let arr=[...commonLow.slice(0,3),'m18_adena_pouch'];
    if(m.min>=20) arr.push(...commonMid.slice(0,3));
    if(m.min>=45) arr.push(...commonHigh.slice(0,3));
    if(m.min>=70) arr.push(...commonHero.slice(0,3),'m18_hero_scroll_piece');
    if(/龍|安塔|巴拉|法利|林德|巢穴|四龍|DVC|dvc/i.test(name+' '+id)) arr.push(...dragonMats,'m18_dragon_metal');
    if(/傲慢|塔|支配|遺忘|古代|地獄|拉斯塔/i.test(name+' '+id)) arr.push('m18_legend_scroll_piece','m18_relic_piece','m18_ancient_gem','m18_ancient_leather','m18_ancient_silk');
    if(/妖精|森林|海音|伊娃|魔法|象牙/i.test(name+' '+id)) arr.push('m18_magic_cloth','m18_magic_gem','m18_crystal','m18_holy_water');
    if(/黑|暗|死|靈魂|影子|地獄/i.test(name+' '+id)) arr.push('m18_soul','m18_dark_soul');
    addDropsToMap(m,[...new Set(arr)]);
  });

  DB.recipes={};
  function recipe(id, req, adena, note){ if(DB.item[id]) DB.recipes[id]={id,req,adena,note}; }
  function autoReq(item){
    const rank=item.rank||'N', type=item.type, mult=rv(rank);
    let req={};
    const add=(id,q)=>{ if(DB.item[id]) req[id]=(req[id]||0)+q; };
    if(type==='weapon'){ add('m18_weapon_frag',8*mult); add(rank==='M'?'m18_dragon_metal':rank==='L'?'m18_oriharucon':'m18_iron_ingot',2*mult); add('m18_powder',3*mult); }
    else if(['helmet','tshirt','armor','cloak','gloves','boots'].includes(type)){ add('m18_armor_frag',8*mult); add(['cloak','tshirt'].includes(type)?'m18_magic_cloth':'m18_hard_leather',2*mult); add('m18_iron_ingot',2*mult); }
    else if(['ring','earring','amulet','belt'].includes(type)){ add('m18_acc_frag',8*mult); add('m18_high_gem',3*mult); add('m18_powder',2*mult); }
    else if(['rune','seal','relic'].includes(type)){ add('m18_relic_piece',5*mult); add('m18_crystal',2*mult); add('m18_holy_water',2*mult); }
    if(['SSR','L','M'].includes(rank)) add('m18_hero_scroll_piece',rank==='SSR'?2:4);
    if(['L','M'].includes(rank)){ add('m18_legend_scroll_piece',rank==='L'?2:5); add('m18_dragon_blood',1*mult); }
    if(rank==='M'){ add('m18_myth_scroll_piece',3); add('m18_dragon_heart',2); }
    return req;
  }
  Object.values(DB.item).forEach(it=>{
    if(['weapon','helmet','tshirt','armor','cloak','gloves','boots','amulet','belt','earring','ring','rune','seal','relic'].includes(it.type) && ['SR','SSR','L','M'].includes(it.rank)){
      recipe(it.id, autoReq(it), Math.max(10000, Math.floor((it.price||1000)*(1.2+rv(it.rank)*.35))), '裝備製作');
    }
    if(it.type==='book' && ['SR','SSR','L','M'].includes(it.rank)){
      const mult=rv(it.rank); recipe(it.id, {'m18_skill_page':8*mult,'m18_crystal':2*mult,'m18_honor_coin':3*mult,[it.rank==='M'?'m18_myth_scroll_piece':it.rank==='L'?'m18_legend_scroll_piece':'m18_hero_scroll_piece']:1*mult}, Math.floor((it.price||50000)*1.5), '技能書製作');
    }
  });
  // 官方感重點裝備補強配方
  recipe('death_blade',{'m18_weapon_frag':80,'m18_oriharucon':8,'m18_dark_soul':4,'m18_hero_scroll_piece':6},350000,'死亡騎士系列武器');
  recipe('dragon_slayer',{'m18_weapon_frag':150,'m18_dragon_metal':10,'m18_dragon_blood':6,'m18_dragon_heart':1,'m18_legend_scroll_piece':5},1800000,'四龍屠龍武器');
  recipe('dragon_armor',{'m18_armor_frag':150,'m18_dragon_leather':12,'m18_dragon_scale_earth':10,'m18_dragon_blood':4,'m18_legend_scroll_piece':5},1600000,'地龍防具');
  recipe('mythic_excalibur',{'m18_weapon_frag':260,'m18_dragon_metal':20,'m18_dragon_heart':5,'m18_myth_scroll_piece':5,'m18_holy_crystal':12},7000000,'神話武器');
  recipe('mythic_armor',{'m18_armor_frag':260,'m18_dragon_leather':20,'m18_dragon_heart':5,'m18_myth_scroll_piece':5,'m18_ancient_leather':15},6800000,'神話防具');
  recipe('relic_dragon',{'m18_relic_piece':120,'m18_dragon_gem':15,'m18_dragon_heart':3,'m18_legend_scroll_piece':6},2500000,'龍之聖物');

  // 分解：讓不需要的裝備能轉為製作材料
  Game.disassemble=function(k){
    const it=this.inv(k), d=it&&this.def(it.id); if(!d) return;
    if(!['weapon','helmet','tshirt','armor','cloak','gloves','boots','amulet','belt','earring','ring','rune','seal','relic'].includes(d.type)){ alert('此道具不可分解'); return; }
    const mult=Math.max(1,rv(d.rank)+(it.enchant||0));
    const base=d.type==='weapon'?'m18_weapon_frag':['helmet','tshirt','armor','cloak','gloves','boots'].includes(d.type)?'m18_armor_frag':['rune','seal','relic'].includes(d.type)?'m18_relic_piece':'m18_acc_frag';
    this.addItem(base,Math.max(2,mult*3));
    if(['SSR','L','M'].includes(d.rank)) this.addItem(d.rank==='M'?'m18_myth_scroll_piece':d.rank==='L'?'m18_legend_scroll_piece':'m18_hero_scroll_piece',1);
    this.rem(k,1); this.log(`分解 ${d.name}，取得製作材料`,'green'); this.render();
  };

  Game.countItem=function(id){ return Object.values(this.s.inv||{}).filter(x=>x.id===id).reduce((a,x)=>a+(x.qty||0),0); };
  Game.consumeItems=function(req){
    for(const [id,need] of Object.entries(req)){ if(this.countItem(id)<need) return false; }
    for(const [id,need0] of Object.entries(req)){
      let need=need0;
      for(const k of Object.keys(this.s.inv)){ const it=this.inv(k); if(!it||it.id!==id) continue; const q=Math.min(need,it.qty||0); this.rem(k,q); need-=q; if(need<=0) break; }
    }
    return true;
  };
  Game.craftRecipe=function(id){
    const r=DB.recipes[id], d=this.def(id); if(!r||!d){ alert('尚未建立此道具配方'); return; }
    const miss=Object.entries(r.req).filter(([mid,q])=>this.countItem(mid)<q).map(([mid,q])=>`${DB.item[mid]?.name||mid} ${this.countItem(mid)}/${q}`);
    if(miss.length){ alert('材料不足：\n'+miss.join('\n')); return; }
    if((this.s.adena||0)<r.adena){ alert('金幣不足'); return; }
    this.s.adena-=r.adena; this.consumeItems(r.req); this.addItem(id,1,0); this.s.ach.craft=(this.s.ach.craft||0)+1; this.log('製作完成：'+d.name,'green'); this.render();
  };

  const oldAction=Game.action;
  Game.action=function(a,arg,b){
    if(a==='craft') return this.craftRecipe(arg);
    if(a==='dis') return this.disassemble(arg);
    return oldAction.call(this,a,arg,b);
  };

  const oldKill=Game.kill;
  Game.kill=function(m,bonus){
    const map=this.map();
    oldKill.call(this,m,bonus);
    const matPool=(map.materialDrops&&map.materialDrops.length?map.materialDrops:map.drops.filter(id=>this.def(id)?.type==='material'));
    if(!matPool.length) return;
    const base=m.boss?.65:.28; // 材料掉落率，Boss較高
    if(Math.random()<base){
      const id=matPool[this.rand(0,matPool.length-1)], d=this.def(id); if(!d) return;
      const qty=m.boss?this.rand(2,6):(rv(d.rank)>=4?1:this.rand(1,3));
      this.addItem(id,qty,0); this.log(`材料掉落：${d.name} ×${qty}`,'green');
    }
    if(m.boss && Math.random()<.35){ const id=['m18_hero_scroll_piece','m18_legend_scroll_piece','m18_dragon_blood','m18_relic_piece'][this.rand(0,3)]; this.addItem(id,1); this.log(`Boss 額外材料：${this.def(id).name} ×1`,'green'); }
  };

  Game.viewCraft=function(){
    const items=Object.values(DB.recipes).map(r=>this.def(r.id)).filter(Boolean).sort((a,b)=>rv(a.rank)-rv(b.rank)||String(a.name).localeCompare(String(b.name),'zh-Hant'));
    const groups=[['武器','weapon'],['防具',['helmet','tshirt','armor','cloak','gloves','boots']],['飾品/符石/聖物',['amulet','belt','earring','ring','rune','seal','relic']],['技能書','book']];
    let html='<h3 class="title">製作 / 詳細材料配方</h3><p class="muted">V18 已改為指定材料配方。材料可由怪物、Boss、地圖掉落或分解裝備取得。</p>';
    html+='<div class="card"><b class="gold">持有材料摘要</b><div class="grid cards" style="margin-top:8px">'+Object.values(DB.item).filter(d=>d.type==='material').map(d=>`<div class="mini"><span class="r-${d.rank}">${esc(d.name)}</span><br><span class="muted">${esc(d.group||'材料')}｜持有 ${this.countItem(d.id)}</span></div>`).join('')+'</div></div>';
    groups.forEach(([title,type])=>{
      const list=items.filter(d=>Array.isArray(type)?type.includes(d.type):d.type===type).slice(0,90);
      html+=`<div class="card"><b class="gold">${title}</b>`+list.map(d=>{
        const r=DB.recipes[d.id];
        const req=Object.entries(r.req).map(([mid,q])=>{const have=this.countItem(mid), md=DB.item[mid]; return `<span class="pill ${have>=q?'green':'red'}">${esc(md?.name||mid)} ${have}/${q}</span>`;}).join('');
        const ok=Object.entries(r.req).every(([mid,q])=>this.countItem(mid)>=q) && (this.s.adena||0)>=r.adena;
        return `<div class="item"><div class="row"><b class="r-${d.rank}">${esc(d.name)}</b><button data-act="craft" data-arg="${d.id}" ${ok?'':'disabled'}>製作</button></div><div class="muted">${esc(r.note||'製作')}｜金幣 ${this.fmt(r.adena)}</div><div>${req}</div></div>`;
      }).join('')+'</div>';
    });
    return html;
  };

  const oldViewBag=Game.viewBag;
  Game.viewBag=function(){
    let html=oldViewBag.call(this);
    html=html.replace(/<button data-act="sell"/g,'<button data-act="dis">分解</button> <button data-act="sell"');
    return html;
  };

  Game.viewHunt=function(){
    const rows=DB.maps.map(m=>`<div class="card item"><b>${esc(m.name)}</b> Lv.${m.min}-${m.max}<br><span class="muted">怪物：${m.mons.map(esc).join('、')}</span><br><span class="muted">裝備/道具：${m.drops.filter(id=>this.def(id)?.type!=='material').slice(0,8).map(id=>esc(this.def(id)?.name||id)).join('、')||'無'}</span><br><span class="green mini">材料：${(m.materialDrops||[]).slice(0,12).map(id=>esc(this.def(id)?.name||id)).join('、')||'無'}</span></div>`).join('');
    return `<h3 class="title">狩獵設定 / 材料掉落表</h3><div class="card"><b class="cyan">V18 材料掉落</b><br><span class="muted">每張地圖已加入指定材料池。擊殺怪物有機率掉落製作材料；Boss 掉落率與數量較高，並可能額外掉落秘笈/龍系材料。</span></div>${rows}`;
  };

  Game.viewAudit=function(){
    const items=Object.values(DB.item), materials=items.filter(i=>i.type==='material'), recipes=Object.keys(DB.recipes||{}), monsters=new Set(DB.maps.flatMap(m=>m.mons));
    const miss=DB.maps.flatMap(m=>m.drops.filter(id=>!DB.item[id]).map(id=>m.name+':'+id));
    const noMat=DB.maps.filter(m=>!(m.materialDrops||[]).length).map(m=>m.name);
    return `<h3 class="title">完整度檢查｜V18 材料製作版</h3><div class="grid cards"><div class="card"><b>職業</b><div class="big gold">${Object.keys(DB.classes).length}</div></div><div class="card"><b>地圖</b><div class="big gold">${DB.maps.length}</div></div><div class="card"><b>怪物</b><div class="big gold">${monsters.size}</div></div><div class="card"><b>裝備/道具</b><div class="big gold">${items.length}</div></div><div class="card"><b>製作材料</b><div class="big gold">${materials.length}</div></div><div class="card"><b>詳細配方</b><div class="big gold">${recipes.length}</div></div><div class="card"><b>材料掉落地圖</b><div class="big gold">${DB.maps.length-noMat.length}/${DB.maps.length}</div></div><div class="card"><b>技能</b><div class="big gold">${Object.keys(DB.skills).length}</div></div></div><div class="card"><b>${miss.length||noMat.length?'資料關聯仍有缺漏':'資料關聯檢查通過'}</b><br><span class="muted">掉落表缺失：${miss.length?miss.join('、'):'無'}<br>未配置材料池地圖：${noMat.length?noMat.join('、'):'無'}<br>V18：製作改為指定材料配方；怪物、Boss、地圖皆已加入材料掉落。</span></div>`;
  };

  const oldDash=Game.viewDash;
  Game.viewDash=function(){
    const base=oldDash.call(this);
    return base+`<div class="card"><b class="gold">V18 製作材料系統</b><p class="muted">已新增 ${Object.values(DB.item).filter(i=>i.type==='material').length} 種材料、${Object.keys(DB.recipes).length} 筆詳細配方，並將材料掉落整合至 ${DB.maps.length} 張地圖的怪物掉落表。</p></div>`;
  };
})();


/* === V19 EQUIPMENT / BAG UX OPTIMIZATION === */
(function(){
  const esc=s=>String(s??'').replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
  const rankOrder={M:6,L:5,SSR:4,SR:3,R:2,N:1};
  const equipTypes=['weapon','helmet','tshirt','armor','cloak','gloves','boots','amulet','belt','earring','ring','rune','seal','relic'];
  const armorTypes=['helmet','tshirt','armor','cloak','gloves','boots'];
  const accTypes=['amulet','belt','earring','ring','rune','seal','relic'];
  const typeName={weapon:'武器',helmet:'頭盔',tshirt:'內衣',armor:'盔甲',cloak:'斗篷',gloves:'手套',boots:'鞋子',amulet:'項鍊',belt:'腰帶',earring:'耳環',ring:'戒指',rune:'符石',seal:'印章',relic:'聖物',potion:'藥水',scroll:'卷軸',material:'材料',book:'技能書',box:'箱子'};
  const statName={str:'STR',dex:'DEX',con:'CON',int:'INT',wis:'WIS',ac:'AC',dmg:'傷害',hit:'命中',dr:'減傷',mr:'MR',spd:'速度',hp:'HP',mp:'MP'};
  Game.bagView=Game.bagView||'equip';
  Game.bagSort=Game.bagSort||'rank';
  Game.equipFilter=Game.equipFilter||'all';
  Game.itemTypeName=function(t){return typeName[t]||t||'道具'};
  Game.statLine=function(d,it){
    const arr=[];
    if(d.dmg) arr.push(`傷害 +${d.dmg+(it?.enchant||0)}`);
    if(d.ac!==undefined) arr.push(`AC ${d.ac-(it?.enchant||0)}`);
    Object.entries(d.stat||{}).forEach(([k,v])=>arr.push(`${statName[k]||k} ${v>0?'+':''}${v}`));
    if(d.weapon) arr.push(`類型：${typeName.weapon}/${d.weapon}`);
    if(d.safe!==undefined && equipTypes.includes(d.type)) arr.push(`安定值 +${d.safe}`);
    return arr.length?arr.join('｜'):'無能力值';
  };
  Game.itemPower=function(d,it){
    let p=(rankOrder[d.rank]||1)*100+(it?.enchant||0)*25;
    if(d.dmg) p+=d.dmg*8;
    if(d.ac!==undefined) p+=Math.abs(d.ac)*7;
    Object.values(d.stat||{}).forEach(v=>{if(typeof v==='number') p+=Math.abs(v)*6;});
    return Math.round(p);
  };
  Game.slotOf=function(type){
    if(type==='ring') return this.s.equip.ring1?'ring2':'ring1';
    if(type==='earring') return this.s.equip.earring1?'earring2':'earring1';
    return type;
  };
  Game.currentEquippedFor=function(d){
    const slots=d.type==='ring'?['ring1','ring2']:d.type==='earring'?['earring1','earring2']:[d.type];
    return slots.map(sl=>this.s.equip[sl]).filter(Boolean).map(k=>this.inv(k)).filter(Boolean);
  };
  Game.compareText=function(d,it){
    if(!equipTypes.includes(d.type)) return '';
    const cur=this.currentEquippedFor(d)[0];
    if(!cur) return '<span class="green">未裝備此部位</span>';
    const cd=this.def(cur.id); if(!cd) return '';
    const diff=this.itemPower(d,it)-this.itemPower(cd,cur);
    return diff>0?`<span class="green">戰力 +${diff}</span>`:diff<0?`<span class="red">戰力 ${diff}</span>`:'<span class="muted">戰力相近</span>';
  };
  Game.canEquipItem=function(d){return d.type!=='weapon'||this.cls().weapons.includes(d.weapon)};
  Game.itemCard=function(k,mode='bag'){
    const it=this.inv(k); if(!it) return '';
    const d=this.def(it.id); if(!d) return '';
    const isEq=Object.values(this.s.equip).includes(k);
    const eqAble=equipTypes.includes(d.type);
    const usable=['potion','box','book'].includes(d.type);
    const canEq=eqAble&&this.canEquipItem(d);
    const qty=it.qty>1?` ×${it.qty}`:'';
    const ench=it.enchant?`+${it.enchant} `:'';
    const actions=[];
    if(eqAble) actions.push(canEq?`<button data-act="equip" data-arg="${esc(k)}">${isEq?'更換':'裝備'}</button>`:`<button disabled>職業不可用</button>`);
    if(eqAble) actions.push(`<button data-act="ench" data-arg="${esc(k)}">強化</button>`);
    if(usable) actions.push(`<button data-act="use" data-arg="${esc(k)}">使用</button>`);
    if(d.type==='book') actions.push(`<button data-act="learnSkill" data-arg="${esc(d.skillId||'')}">學習</button>`);
    if(d.type==='material') actions.push(`<button disabled>製作用</button>`);
    if(!isEq && !['potion','scroll','book','box'].includes(d.type)) actions.push(`<button data-act="dis" data-arg="${esc(k)}">分解</button>`);
    if(!isEq) actions.push(`<button data-act="sell" data-arg="${esc(k)}" class="red">賣出</button>`);
    return `<div class="inv-card ${isEq?'on':''}"><div class="row"><div><b class="r-${d.rank}">${ench}${esc(d.name)}${qty}</b><br><span class="muted">${esc(this.itemTypeName(d.type))}｜${R[d.rank]?.[0]||d.rank}｜戰力 ${this.itemPower(d,it)}</span></div><span class="pill">${esc(d.rank)}</span></div><div class="mini muted">${esc(this.statLine(d,it))}</div><div class="mini">${this.compareText(d,it)}</div><div class="row" style="justify-content:flex-start;flex-wrap:wrap;margin-top:8px">${actions.join(' ')}</div></div>`;
  };

  const oldAction=Game.action;
  Game.action=function(a,arg,b){
    if(a==='bagView'){this.bagView=arg||'all';this.renderTab();return;}
    if(a==='bagSort'){this.bagSort=arg||'rank';this.renderTab();return;}
    if(a==='equipFilter'){this.equipFilter=arg||'all';this.renderTab();return;}
    if(a==='unequip'){if(this.s.equip[arg]){this.s.equip[arg]=null;this.render();}return;}
    if(a==='equipBest'){
      this.autoEquipBest(); this.render(); return;
    }
    return oldAction.call(this,a,arg,b);
  };
  Game.autoEquipBest=function(){
    const slots=Object.keys(this.slots());
    const pool=Object.keys(this.s.inv).filter(k=>{const d=this.def(this.inv(k).id);return d&&equipTypes.includes(d.type)&&this.canEquipItem(d);});
    slots.forEach(sl=>{
      const valid=pool.filter(k=>{const d=this.def(this.inv(k).id); if(sl==='ring1'||sl==='ring2') return d.type==='ring'; if(sl==='earring1'||sl==='earring2') return d.type==='earring'; return d.type===sl;});
      if(!valid.length) return;
      valid.sort((a,b)=>this.itemPower(this.def(this.inv(b).id),this.inv(b))-this.itemPower(this.def(this.inv(a).id),this.inv(a)));
      const best=valid.find(k=>!Object.values(this.s.equip).includes(k)||this.s.equip[sl]===k);
      if(best) this.s.equip[sl]=best;
    });
    this.log('已依戰力自動套用最佳裝備','green');
  };

  Game.viewEquip=function(){
    const slots=this.slots();
    const st=this.total();
    const filters=[['all','全部'],['weapon','武器'],['armor','防具'],['accessory','飾品/特殊']];
    const slotRows=Object.entries(slots).filter(([sl])=>{
      if(this.equipFilter==='all') return true;
      if(this.equipFilter==='weapon') return sl==='weapon';
      if(this.equipFilter==='armor') return armorTypes.includes(sl);
      if(this.equipFilter==='accessory') return accTypes.includes(sl.replace(/[12]$/,''));
      return true;
    }).map(([sl,label])=>{
      const k=this.s.equip[sl];
      if(!k) return `<div class="equip-slot empty"><div><b>${esc(label)}</b><br><span class="muted">未裝備</span></div></div>`;
      const it=this.inv(k), d=it&&this.def(it.id);
      if(!d) return `<div class="equip-slot empty"><b>${esc(label)}</b><br><span class="red">裝備資料遺失</span><button data-act="unequip" data-arg="${esc(sl)}">清除</button></div>`;
      return `<div class="equip-slot"><div class="row"><div><b>${esc(label)}</b><br><span class="r-${d.rank}">${it.enchant?'+'+it.enchant+' ':''}${esc(d.name)}</span></div><span class="pill">${esc(d.rank)}</span></div><div class="mini muted">${esc(this.statLine(d,it))}</div><div class="row" style="justify-content:flex-start;margin-top:8px"><button data-act="unequip" data-arg="${esc(sl)}">卸下</button><button data-act="ench" data-arg="${esc(k)}">強化</button></div></div>`;
    }).join('');
    const candidates=Object.keys(this.s.inv).filter(k=>{const d=this.def(this.inv(k).id);return d&&equipTypes.includes(d.type)&&!Object.values(this.s.equip).includes(k);}).sort((a,b)=>this.itemPower(this.def(this.inv(b).id),this.inv(b))-this.itemPower(this.def(this.inv(a).id),this.inv(a))).slice(0,12).map(k=>this.itemCard(k)).join('');
    return `<h3 class="title">裝備</h3><div class="grid cards"><div class="card"><b>目前能力</b><div class="mini muted">AC ${st.ac}｜傷害 ${Math.floor(st.dmg+this.s.lv*2)}｜命中 ${st.hit||0}｜減傷 ${st.dr||0}｜MR ${st.mr||0}</div></div><div class="card"><b>快速操作</b><br><button data-act="equipBest" class="gold">一鍵最佳裝備</button></div></div><div class="tabs" style="margin:10px 0">${filters.map(([id,n])=>`<button class="tab ${this.equipFilter===id?'on':''}" data-act="equipFilter" data-arg="${id}">${n}</button>`).join('')}</div><div class="equip-grid">${slotRows}</div><h4 class="title">可替換裝備</h4><div class="inv-grid">${candidates||'<p class="muted">背包沒有可替換裝備</p>'}</div>`;
  };

  Game.viewBag=function(){
    const filters=[['all','全部'],['equip','裝備'],['material','材料'],['book','技能書'],['consumable','消耗品']];
    const sorts=[['rank','稀有度'],['type','類型'],['qty','數量'],['name','名稱']];
    let keys=Object.keys(this.s.inv);
    keys=keys.filter(k=>{const d=this.def(this.inv(k).id); if(!d) return false; if(this.bagView==='all') return true; if(this.bagView==='equip') return equipTypes.includes(d.type); if(this.bagView==='consumable') return ['potion','scroll','box'].includes(d.type); return d.type===this.bagView;});
    keys.sort((a,b)=>{const ia=this.inv(a), ib=this.inv(b), da=this.def(ia.id), db=this.def(ib.id); if(this.bagSort==='type') return String(da.type).localeCompare(String(db.type),'zh-Hant') || (rankOrder[db.rank]-rankOrder[da.rank]); if(this.bagSort==='qty') return (ib.qty||1)-(ia.qty||1); if(this.bagSort==='name') return String(da.name).localeCompare(String(db.name),'zh-Hant'); return (rankOrder[db.rank]-rankOrder[da.rank]) || this.itemPower(db,ib)-this.itemPower(da,ia);});
    const summary={all:Object.keys(this.s.inv).length,equip:0,material:0,book:0,consumable:0};
    Object.values(this.s.inv).forEach(it=>{const d=this.def(it.id); if(!d)return; if(equipTypes.includes(d.type))summary.equip++; if(d.type==='material')summary.material+=(it.qty||1); if(d.type==='book')summary.book+=(it.qty||1); if(['potion','scroll','box'].includes(d.type))summary.consumable+=(it.qty||1);});
    return `<h3 class="title">背包</h3><div class="bag-summary"><div class="card">格數 <b class="gold">${summary.all}</b></div><div class="card">裝備 <b class="gold">${summary.equip}</b></div><div class="card">材料 <b class="gold">${summary.material}</b></div><div class="card">技能書 <b class="gold">${summary.book}</b></div><div class="card">消耗品 <b class="gold">${summary.consumable}</b></div></div><div class="bag-tools"><div class="tabs">${filters.map(([id,n])=>`<button class="tab ${this.bagView===id?'on':''}" data-act="bagView" data-arg="${id}">${n}</button>`).join('')}</div><div class="tabs">${sorts.map(([id,n])=>`<button class="tab ${this.bagSort===id?'on':''}" data-act="bagSort" data-arg="${id}">排序：${n}</button>`).join('')}</div></div><div class="inv-grid">${keys.map(k=>this.itemCard(k)).join('')||'<p class="muted">此分類沒有道具</p>'}</div>`;
  };

  const css=document.createElement('style');
  css.textContent=`
  .bag-summary{display:grid;grid-template-columns:repeat(auto-fit,minmax(120px,1fr));gap:8px;margin-bottom:10px}.bag-summary .card{padding:8px 10px}.bag-tools{display:flex;gap:8px;justify-content:space-between;align-items:center;flex-wrap:wrap;margin:8px 0 12px}.inv-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:10px}.inv-card{background:#081120;border:1px solid #26364e;border-radius:12px;padding:10px;min-height:128px}.inv-card.on{border-color:var(--gold);background:#16180d}.inv-card .row button{padding:5px 8px}.equip-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:10px}.equip-slot{background:#081120;border:1px solid #26364e;border-radius:12px;padding:10px;min-height:120px}.equip-slot.empty{opacity:.78;background:#070d18;border-style:dashed}.mini{line-height:1.45}.tabs .tab{white-space:nowrap}`;
  document.head.appendChild(css);
})();


/* V20：變身 / 魔法娃娃、合成頁面優化 */
(function(){
  const esc=s=>String(s??'').replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
  const rankOrder={N:1,R:2,SR:3,SSR:4,L:5,M:6};
  const rankNames={N:'一般',R:'高級',SR:'稀有',SSR:'英雄',L:'傳說',M:'神話'};
  const kindName={transform:'變身',doll:'魔法娃娃'};
  const combineRates={N:75,R:55,SR:35,SSR:18,L:6};
  Game.cardKindFilter=Game.cardKindFilter||'all';
  Game.cardRankFilter=Game.cardRankFilter||'all';
  Game.cardOwnFilter=Game.cardOwnFilter||'all';
  Game.combineKind=Game.combineKind||'transform';

  Game.cardStatLine=function(c){
    const stat=c.stat||{};
    const map={str:'STR',dex:'DEX',con:'CON',int:'INT',wis:'WIS',dmg:'傷害',hit:'命中',dr:'減傷',mr:'MR',spd:'攻速',hp:'HP',mp:'MP',ac:'AC'};
    return Object.keys(stat).length?Object.entries(stat).map(([k,v])=>`${map[k]||k} +${v}`).join('、'):'無能力加成';
  };
  Game.cardPower=function(c){
    const st=c.stat||{};
    return Math.floor((rankOrder[c.rank]||1)*100+(st.dmg||0)*18+(st.hit||0)*12+(st.dr||0)*18+(st.spd||0)*8+(st.hp||0)/8+(st.mp||0)/10+(st.str||0)*15+(st.dex||0)*15+(st.int||0)*15+(st.wis||0)*12+(st.mr||0)*4);
  };
  Game.cardSummary=function(){
    const cards=Object.values(DB.cards);
    const owned=cards.filter(c=>(this.s.cards[c.id]||0)>0);
    const dup=owned.reduce((a,c)=>a+Math.max(0,(this.s.cards[c.id]||0)-1),0);
    const byKind={transform:owned.filter(c=>c.kind==='transform').length,doll:owned.filter(c=>c.kind==='doll').length};
    const byRank={}; ['N','R','SR','SSR','L','M'].forEach(r=>byRank[r]=owned.filter(c=>c.rank===r).length);
    return {total:cards.length,owned:owned.length,dup,byKind,byRank};
  };
  Game.bestCard=function(kind){
    return Object.values(DB.cards).filter(c=>c.kind===kind&&(this.s.cards[c.id]||0)>0).sort((a,b)=>this.cardPower(b)-this.cardPower(a))[0];
  };
  Game.activateBestCards=function(){
    ['transform','doll'].forEach(k=>{const c=this.bestCard(k); if(c)this.s.active[k]=c.id;});
    this.log('已套用目前擁有的最佳變身與魔法娃娃','green');
  };
  Game.cardTile=function(c){
    const qty=this.s.cards[c.id]||0;
    const active=this.s.active[c.kind]===c.id;
    const can=qty>0;
    return `<div class="card-tile ${active?'active':''} ${can?'owned':'locked'}">
      <div class="row"><div><b class="r-${c.rank}">${esc(c.name)}</b><br><span class="muted">${kindName[c.kind]}｜${rankNames[c.rank]||c.rank}｜戰力 ${this.cardPower(c)}</span></div><span class="pill r-${c.rank}">${c.rank}</span></div>
      <div class="mini muted">${esc(this.cardStatLine(c))}</div>
      <div class="row" style="margin-top:8px"><span>${can?`持有 <b class="gold">${qty}</b> 張`:'未取得'}</span><span>${active?'<b class="green">使用中</b>':(can?`<button data-act="active" data-arg="${esc(c.id)}">啟用</button>`:'')}</span></div>
    </div>`;
  };

  Game.viewCards=function(){
    const s=this.cardSummary();
    const filtersKind=[['all','全部'],['transform','變身'],['doll','魔法娃娃']];
    const filtersRank=[['all','全部'],['N','一般'],['R','高級'],['SR','稀有'],['SSR','英雄'],['L','傳說'],['M','神話']];
    const filtersOwn=[['all','全部'],['owned','已持有'],['missing','未取得']];
    const activeT=this.s.active.transform?this.card(this.s.active.transform):null;
    const activeD=this.s.active.doll?this.card(this.s.active.doll):null;
    let list=Object.values(DB.cards).filter(c=>{
      if(this.cardKindFilter!=='all'&&c.kind!==this.cardKindFilter)return false;
      if(this.cardRankFilter!=='all'&&c.rank!==this.cardRankFilter)return false;
      const owned=(this.s.cards[c.id]||0)>0;
      if(this.cardOwnFilter==='owned'&&!owned)return false;
      if(this.cardOwnFilter==='missing'&&owned)return false;
      return true;
    }).sort((a,b)=>(rankOrder[b.rank]-rankOrder[a.rank])||this.cardPower(b)-this.cardPower(a)||a.name.localeCompare(b.name,'zh-Hant'));
    return `<h3 class="title">變身 / 魔法娃娃</h3>
      <div class="card-dashboard">
        <div class="card"><b>圖鑑完成度</b><div class="big gold">${s.owned}/${s.total}</div><span class="muted">重複卡 ${s.dup} 張，可用於合成</span></div>
        <div class="card"><b>目前變身</b><div class="r-${activeT?.rank||'N'}">${activeT?esc(activeT.name):'未啟用'}</div><span class="muted">${activeT?esc(this.cardStatLine(activeT)):'尚未選擇'}</span></div>
        <div class="card"><b>目前娃娃</b><div class="r-${activeD?.rank||'N'}">${activeD?esc(activeD.name):'未召喚'}</div><span class="muted">${activeD?esc(this.cardStatLine(activeD)):'尚未選擇'}</span></div>
        <div class="card"><b>快速操作</b><br><button data-act="bestCards" class="gold">一鍵套用最佳</button></div>
      </div>
      <div class="card-filter"><div class="tabs">${filtersKind.map(([id,n])=>`<button class="tab ${this.cardKindFilter===id?'on':''}" data-act="cardKind" data-arg="${id}">${n}</button>`).join('')}</div><div class="tabs">${filtersRank.map(([id,n])=>`<button class="tab ${this.cardRankFilter===id?'on':''}" data-act="cardRank" data-arg="${id}">${n}</button>`).join('')}</div><div class="tabs">${filtersOwn.map(([id,n])=>`<button class="tab ${this.cardOwnFilter===id?'on':''}" data-act="cardOwn" data-arg="${id}">${n}</button>`).join('')}</div></div>
      <div class="rank-strip">${['N','R','SR','SSR','L','M'].map(r=>`<span class="pill r-${r}">${rankNames[r]} ${s.byRank[r]||0}</span>`).join('')}</div>
      <div class="card-grid">${list.map(c=>this.cardTile(c)).join('')||'<p class="muted">沒有符合條件的卡片</p>'}</div>`;
  };

  Game.combineInfo=function(kind,rank){
    const pool=Object.values(DB.cards).filter(c=>c.kind===kind&&c.rank===rank);
    const owned=pool.reduce((a,c)=>a+(this.s.cards[c.id]||0),0);
    const dup=pool.reduce((a,c)=>a+Math.max(0,(this.s.cards[c.id]||0)-1),0);
    const usable=Math.floor(owned/4);
    return {owned,dup,usable};
  };
  Game.combineAll=function(kind,rank){
    const info=this.combineInfo(kind,rank);
    if(info.usable<=0){alert('此階級卡片不足 4 張');return;}
    let n=info.usable;
    while(n-->0)this.combine(kind,rank);
    this.render();
  };
  Game.viewCombine=function(){
    const ranks=['N','R','SR','SSR','L'];
    const kind=this.combineKind||'transform';
    const activeKinds=[['transform','變身合成'],['doll','娃娃合成']];
    const rows=ranks.map(r=>{const info=this.combineInfo(kind,r);return `<div class="combine-row"><div><b class="r-${r}">${rankNames[r]}</b><br><span class="muted">持有 ${info.owned}｜重複 ${info.dup}｜可合成 ${info.usable} 次｜升階率 ${combineRates[r]}%</span></div><div><button data-act="combine" data-arg="${kind}|${r}" ${info.owned<4?'disabled':''}>合成一次</button> <button data-act="combineAll" data-arg="${kind}|${r}" ${info.owned<4?'disabled':''} class="gold">全部合成</button></div></div>`}).join('');
    const cards=Object.values(DB.cards).filter(c=>c.kind===kind).sort((a,b)=>(rankOrder[b.rank]-rankOrder[a.rank])||a.name.localeCompare(b.name,'zh-Hant')).map(c=>`<div class="mini-card"><span class="r-${c.rank}">${esc(c.name)}</span><b>${this.s.cards[c.id]||0}</b></div>`).join('');
    return `<h3 class="title">卡片合成</h3>
      <div class="card"><b>合成規則</b><br><span class="muted">4 張同類同階卡片可合成。成功時升一階，失敗時回傳同階隨機卡。神話階不參與合成。</span></div>
      <div class="tabs" style="margin:10px 0">${activeKinds.map(([id,n])=>`<button class="tab ${kind===id?'on':''}" data-act="combineKind" data-arg="${id}">${n}</button>`).join('')}</div>
      <div class="combine-panel">${rows}</div>
      <h4 class="title">目前${kindName[kind]}持有清單</h4><div class="mini-card-grid">${cards}</div>`;
  };

  const oldAction=Game.action;
  Game.action=function(a,arg,b){
    if(a==='cardKind'){this.cardKindFilter=arg||'all';this.renderTab();return;}
    if(a==='cardRank'){this.cardRankFilter=arg||'all';this.renderTab();return;}
    if(a==='cardOwn'){this.cardOwnFilter=arg||'all';this.renderTab();return;}
    if(a==='bestCards'){this.activateBestCards();this.render();return;}
    if(a==='combineKind'){this.combineKind=arg||'transform';this.renderTab();return;}
    if(a==='combineAll'){let [k,r]=String(arg||'').split('|');this.combineAll(k,r);return;}
    return oldAction.call(this,a,arg,b);
  };

  const css=document.createElement('style');
  css.textContent=`
  .card-dashboard{display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:10px;margin-bottom:10px}.card-filter{display:flex;gap:8px;justify-content:space-between;align-items:center;flex-wrap:wrap;margin:10px 0}.rank-strip{margin:8px 0 12px}.card-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:10px}.card-tile{background:#081120;border:1px solid #26364e;border-radius:12px;padding:10px;min-height:128px}.card-tile.active{border-color:var(--gold);background:#17170b}.card-tile.locked{opacity:.58}.card-tile.owned{box-shadow:inset 0 0 0 1px rgba(250,204,21,.04)}.combine-panel{display:grid;gap:10px}.combine-row{display:grid;grid-template-columns:1fr auto;gap:10px;align-items:center;background:#081120;border:1px solid #26364e;border-radius:12px;padding:10px}.mini-card-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:8px}.mini-card{display:flex;align-items:center;justify-content:space-between;background:#07101d;border:1px solid #26364e;border-radius:10px;padding:8px 10px}.big{font-size:28px}.tabs .tab{white-space:nowrap}@media(max-width:720px){.combine-row{grid-template-columns:1fr}.card-filter{align-items:flex-start}}`;
  document.head.appendChild(css);
})();


(function(){
  const esc=s=>String(s??'').replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
  const rankText={N:'一般',R:'高級',SR:'稀有',SSR:'英雄',L:'傳說',M:'神話'};
  const rankVal={N:1,R:2,SR:3,SSR:4,L:5,M:6};
  const typeText={weapon:'武器',helmet:'頭盔',tshirt:'內衣',armor:'盔甲',cloak:'斗篷',gloves:'手套',boots:'鞋子',amulet:'項鍊',belt:'腰帶',earring:'耳環',ring:'戒指',rune:'符石',seal:'印章',relic:'聖物',material:'材料',book:'技能書',scroll:'卷軸',potion:'藥水',box:'箱子'};
  const statText={str:'力量',dex:'敏捷',con:'體質',int:'智力',wis:'精神',ac:'AC',dmg:'傷害',hit:'命中',dr:'減傷',mr:'魔防',spd:'速度',hp:'HP',mp:'MP'};
  const f=n=>Math.floor(n||0).toLocaleString();
  const itemName=id=>DB.item[id]?DB.item[id].name:id;
  const statLine=o=>Object.entries(o||{}).map(([k,v])=>(statText[k]||k)+(v>=0?'+':'')+v).join('、')||'無';
  const itemPower=d=>{ if(!d)return 0; let v=(rankVal[d.rank]||1)*10+(d.dmg||0)*3-(d.ac||0)*2; Object.values(d.stat||{}).forEach(x=>v+=Math.abs(x)*4); return Math.round(v); };
  Game.pageState=Game.pageState||{};
  Game.hero=function(title,sub,actions=''){
    return `<div class="page-hero"><div><h3 class="title">${title}</h3>${sub?`<div class="muted">${sub}</div>`:''}</div><div class="hero-actions">${actions}</div></div>`;
  };
  Game.statCards=function(arr){return `<div class="page-grid">${arr.map(x=>`<div class="metric-card"><span>${x[0]}</span><b class="${x[2]||'gold'}">${x[1]}</b>${x[3]?`<small>${x[3]}</small>`:''}</div>`).join('')}</div>`;};
  Game.itemCount=function(id){return Object.values(this.s.inv||{}).filter(x=>x.id===id).reduce((a,x)=>a+(x.qty||0),0)};
  Game.recipeReady=function(r){return Object.entries(r.req||{}).every(([id,q])=>this.itemCount(id)>=q)&&this.s.adena>=r.adena};

  Game.viewDash=function(){
    const st=this.total(), power=Math.max(0,Math.floor((st.dmg+this.s.lv*2)*18+(10-st.ac)*12+(st.dr||0)*35+(st.hit||0)*15+(st.hp||0)/3+this.s.lv*42));
    const ownedCards=Object.keys(this.s.cards||{}).filter(id=>(this.s.cards[id]||0)>0).length;
    const learned=Object.keys(this.s.learnedSkills||{}).filter(id=>this.s.learnedSkills[id]).length;
    const quick=`<button data-act="saveNow" class="blue">快速儲存</button><button data-act="bestEquip" class="gold">最佳裝備</button><button data-act="bestCards">最佳卡片</button>`;
    return this.hero('總覽儀表板',`Lv.${this.s.lv} ${this.cls().name}｜${this.map().name}｜核心頁面已統一優化`,quick)+
      this.statCards([['戰力',f(power),'gold','裝備/技能/卡片合計'],['金幣',f(this.s.adena),'gold'],['鑽石',f(this.s.diamond),'cyan'],['葉子',Math.floor(this.s.leaf||0)+'/200','green'],['已學技能',learned+'/'+this.classSkills().length,'blue'],['卡片圖鑑',ownedCards+'/'+Object.keys(DB.cards).length,'purple']])+
      `<div class="two-col"><div class="card"><b>今日進度</b><div class="progress-list"><p>副本剩餘 <b class="gold">${this.s.daily.dungeon}</b></p><p>世界王剩餘 <b class="gold">${this.s.daily.boss}</b></p><p>今日擊殺 <b class="green">${this.s.daily.kills||0}</b></p><p>鑽石任務階段 <b class="cyan">${this.s.daily.diamondQuest||0}</b></p></div><button data-act="mail">領取每日信箱</button> <button data-act="tj" class="gold">TJ補償</button></div><div class="card"><b>目前狀態</b><div class="pill-row"><span class="pill">AC ${st.ac}</span><span class="pill">傷害 ${Math.floor(st.dmg+this.s.lv*2)}</span><span class="pill">命中 ${st.hit||0}</span><span class="pill">減傷 ${st.dr||0}</span><span class="pill">MR ${st.mr||0}</span><span class="pill">速度 ${st.spd||0}%</span></div><div class="muted">目前變身：${this.s.active.transform?esc(this.card(this.s.active.transform).name):'未啟用'}｜娃娃：${this.s.active.doll?esc(this.card(this.s.active.doll).name):'未召喚'}</div></div></div>`;
  };

  Game.viewHunt=function(){
    const maps=DB.maps.map(m=>{let active=m.id===this.s.map;let drops=(m.drops||[]).slice(0,12).map(id=>`<span class="pill">${esc(itemName(id))}</span>`).join('');return `<div class="list-card ${active?'active':''}"><div class="row"><div><b>${esc(m.name)}</b><br><span class="muted">Lv.${m.min}-${m.max}｜怪物：${(m.mons||[]).map(esc).join('、')}</span></div><button data-act="goMap" data-arg="${m.id}" ${active?'disabled':''}>${active?'狩獵中':'前往'}</button></div><div class="drop-box">${drops}</div></div>`}).join('');
    return this.hero('狩獵 / 地圖','地圖、怪物、掉落、鑽石掉落規則集中顯示。')+
      this.statCards([['目前地圖',esc(this.map().name),'gold'],['怪物種類',new Set(DB.maps.flatMap(m=>m.mons)).size,'red'],['地圖數',DB.maps.length,'blue'],['今日擊殺',this.s.daily.kills||0,'green']])+
      `<div class="card"><b class="cyan">鑽石掉落規則</b><div class="pill-row"><span class="pill">一般怪 0.5%</span><span class="pill">地監/菁英 3%</span><span class="pill">高階地圖 5%</span><span class="pill">四龍地區 8%</span><span class="pill">野外 Boss 30%</span></div></div><div class="page-list">${maps}</div>`;
  };

  Game.viewDraw=function(){
    const cards=Object.values(DB.cards); const tr=cards.filter(c=>c.kind==='transform').length, dl=cards.filter(c=>c.kind==='doll').length;
    return this.hero('抽卡 / 卡池','抽卡入口、機率階級與卡池數量整理。')+
      this.statCards([['變身卡池',tr,'gold'],['娃娃卡池',dl,'purple'],['持有卡片',Object.values(this.s.cards||{}).reduce((a,b)=>a+b,0),'green'],['鑽石',f(this.s.diamond),'cyan']])+
      `<div class="two-col"><div class="card shop-card"><b>變身抽卡</b><p class="muted">一般～神話，適合提升攻速、命中、近戰/遠程輸出。</p><button data-act="drawT" data-arg="1">抽 1 次｜120 鑽</button><button data-act="drawT" data-arg="11" class="gold">抽 11 次｜1320 鑽</button></div><div class="card shop-card"><b>魔法娃娃抽卡</b><p class="muted">一般～神話，偏向生存、魔攻、減傷與輔助加成。</p><button data-act="drawD" data-arg="1">抽 1 次｜100 鑽</button><button data-act="drawD" data-arg="11" class="gold">抽 11 次｜1100 鑽</button></div></div><div class="card"><b>階級機率說明</b><div class="rank-bar"><span class="r-N">一般</span><span class="r-R">高級</span><span class="r-SR">稀有</span><span class="r-SSR">英雄</span><span class="r-L">傳說</span><span class="r-M">神話</span></div></div>`;
  };

  Game.viewCodex=function(){
    const done=Object.keys(this.s.codex||{}).filter(k=>this.s.codex[k]).length;
    const rows=DB.codex.map((c,i)=>{let ok=c[1].every(id=>DB.cards[id]?this.s.cards[id]>0:Object.values(this.s.inv).some(x=>x.id===id));let registered=!!this.s.codex[i];return `<div class="list-card ${registered?'done':''}"><div class="row"><div><b>${esc(c[0])}</b> ${registered?'<span class="green">已完成</span>':ok?'<span class="gold">可登錄</span>':'<span class="muted">未完成</span>'}<br><span class="muted">需求：${c[1].map(id=>esc(itemName(id)||DB.cards[id]?.name)).join('、')}</span><br><span class="muted">加成：${statLine(c[2])}</span></div><button data-act="codex" data-arg="${i}" ${registered||!ok?'disabled':''}>登錄</button></div></div>`}).join('');
    return this.hero('收藏系統','裝備、變身、娃娃收藏統一列表。')+this.statCards([['完成收藏',done+'/'+DB.codex.length,'gold'],['可登錄',DB.codex.filter((c,i)=>!this.s.codex[i]&&c[1].every(id=>DB.cards[id]?this.s.cards[id]>0:Object.values(this.s.inv).some(x=>x.id===id))).length,'green']])+`<div class="page-list">${rows}</div>`;
  };

  Game.viewDungeon=function(){
    const rows=DB.dungeons.map(d=>{let lvOk=this.s.lv>=d.lv, costOk=this.s.diamond>=d.cost, can=this.s.daily.dungeon>0&&lvOk&&costOk;return `<div class="list-card"><div class="row"><div><b>${esc(d.name)}</b><br><span class="muted">需求 Lv.${d.lv}｜消耗 ${d.cost} 鑽｜金幣獎勵 ${f(d.reward)}</span></div><button data-act="dg" data-arg="${d.id}" ${can?'':'disabled'}>進入</button></div><div class="pill-row"><span class="pill ${lvOk?'green':'red'}">等級${lvOk?'符合':'不足'}</span><span class="pill ${costOk?'green':'red'}">鑽石${costOk?'足夠':'不足'}</span></div></div>`}).join('');
    return this.hero('副本 / 活動',`今日剩餘 ${this.s.daily.dungeon} 次。`)+this.statCards([['副本次數',this.s.daily.dungeon,'gold'],['副本數',DB.dungeons.length,'blue'],['角色等級','Lv.'+this.s.lv,'green']])+`<div class="page-list">${rows}</div>`;
  };

  Game.viewBoss=function(){
    const rows=DB.bosses.map(b=>{let can=this.s.daily.boss>0&&this.s.lv>=b.lv-15;return `<div class="list-card boss-card"><div class="row"><div><b class="red">${esc(b.name)}</b><br><span class="muted">建議 Lv.${b.lv}｜HP ${f(b.hp)}｜世界王獎勵：祝福卷軸/材料/鑽石</span></div><button data-act="boss" data-arg="${b.id}" ${can?'':'disabled'}>討伐</button></div></div>`}).join('');
    return this.hero('世界王 / 四龍',`今日剩餘 ${this.s.daily.boss} 次。高階 Boss 會給較多鑽石。`)+this.statCards([['世界王次數',this.s.daily.boss,'gold'],['Boss 數',DB.bosses.length,'red'],['已討伐',this.s.ach.boss||0,'green']])+`<div class="page-list">${rows}</div>`;
  };

  Game.viewGuild=function(){
    return this.hero('血盟','血盟等級、捐獻、血盟技能整合。')+
      this.statCards([['血盟等級','Lv.'+this.s.guild.lv,'gold'],['貢獻',this.s.guild.donate,'green'],['血盟技能','+'+this.s.guild.skill+' 傷害','blue']])+
      `<div class="two-col"><div class="card"><b>${esc(this.s.guild.name)}</b><p class="muted">捐獻可累積貢獻，每 5 次捐獻提升血盟等級。</p><button data-act="donate">捐獻 10,000 金幣</button></div><div class="card"><b>血盟技能</b><p class="muted">消耗 3 貢獻，永久增加角色傷害。</p><button data-act="guildskill" class="gold" ${this.s.guild.donate>=3?'':'disabled'}>升級血盟技能</button></div></div>`;
  };

  Game.viewCraft=function(){
    const recipes=Object.values(DB.recipes||{}); const filter=this.pageState.craftFilter||'all';
    const cats=[['all','全部'],['weapon','武器'],['armor','防具'],['accessory','飾品/特殊'],['book','技能書']];
    const list=recipes.map(r=>this.def(r.id)).filter(Boolean).filter(d=>filter==='all'||(filter==='accessory'?['ring','earring','amulet','belt','rune','seal','relic'].includes(d.type):d.type===filter|| (filter==='armor'&&['helmet','tshirt','armor','cloak','gloves','boots'].includes(d.type)))).sort((a,b)=>(rankVal[b.rank]-rankVal[a.rank])||itemPower(b)-itemPower(a));
    const rows=list.map(d=>{let r=DB.recipes[d.id], ok=this.recipeReady(r);let req=Object.entries(r.req||{}).map(([id,q])=>{let have=this.itemCount(id);return `<span class="pill ${have>=q?'green':'red'}">${esc(itemName(id))} ${have}/${q}</span>`}).join('');return `<div class="list-card"><div class="row"><div><b class="r-${d.rank}">${esc(d.name)}</b><br><span class="muted">${typeText[d.type]||d.type}｜${rankText[d.rank]}｜金幣 ${f(r.adena)}｜${esc(r.note||'製作')}</span></div><button data-act="craft" data-arg="${d.id}" ${ok?'':'disabled'}>製作</button></div><div class="drop-box">${req}</div></div>`}).join('');
    return this.hero('製作 / 材料','配方、需求材料、持有數量、可製作狀態已詳細化。')+this.statCards([['配方',recipes.length,'gold'],['材料種類',Object.values(DB.item).filter(i=>i.type==='material').length,'green'],['持有材料',Object.values(this.s.inv).filter(x=>this.def(x.id)?.type==='material').reduce((a,x)=>a+x.qty,0),'blue']])+`<div class="tabs page-tabs">${cats.map(([id,n])=>`<button class="tab ${filter===id?'on':''}" data-act="craftFilter" data-arg="${id}">${n}</button>`).join('')}</div><div class="page-list">${rows||'<p class="muted">沒有符合條件的配方</p>'}</div>`;
  };

  Game.viewMarket=function(){
    const filter=this.pageState.marketFilter||'all'; const cats=[['all','全部'],['weapon','武器'],['armor','防具'],['material','材料'],['scroll','卷軸'],['book','技能書']];
    const items=Object.values(DB.item).filter(d=>filter==='all'||d.type===filter||(filter==='armor'&&['helmet','tshirt','armor','cloak','gloves','boots'].includes(d.type))).sort((a,b)=>(rankVal[b.rank]-rankVal[a.rank])||(b.price||0)-(a.price||0)).slice(0,80);
    return this.hero('交易所','單機模擬行情，依道具資料庫自動產生。')+this.statCards([['上架品項',items.length,'gold'],['資料庫道具',Object.keys(DB.item).length,'blue'],['金幣',f(this.s.adena),'gold']])+`<div class="tabs page-tabs">${cats.map(([id,n])=>`<button class="tab ${filter===id?'on':''}" data-act="marketFilter" data-arg="${id}">${n}</button>`).join('')}</div><div class="market-table"><div class="mrow head"><span>道具</span><span>類型</span><span>行情</span><span>戰力</span></div>${items.map(d=>`<div class="mrow"><span class="r-${d.rank}">${esc(d.name)}</span><span>${typeText[d.type]||d.type}</span><span>${f(d.price||0)} 金幣</span><span>${itemPower(d)}</span></div>`).join('')}</div>`;
  };

  Game.viewGrowth=function(){
    const rows=[['mastery','武器熟練','增加固定傷害，適合所有物理職業'],['magic','魔法研究','增加魔防與技能系統延伸能力'],['pvp','競技訓練','提升競技場表現與後續 PVP 擴充']].map(([id,n,desc])=>{let lv=this.s.growth[id]||0,cost=(lv+1)*100000;return `<div class="list-card"><div class="row"><div><b>${n}</b> <span class="gold">Lv.${lv}</span><br><span class="muted">${desc}｜升級費用 ${f(cost)} 金幣</span></div><button data-act="growth" data-arg="${id}" ${this.s.adena>=cost?'':'disabled'}>升級</button></div></div>`}).join('');
    return this.hero('成長 / 紋樣 / 守護星盤','長期養成入口，與戰力計算連動。')+this.statCards([['武器熟練','Lv.'+(this.s.growth.mastery||0),'gold'],['魔法研究','Lv.'+(this.s.growth.magic||0),'blue'],['競技訓練','Lv.'+(this.s.growth.pvp||0),'purple']])+`<div class="page-list">${rows}</div>`;
  };

  Game.viewPvp=function(){
    const st=this.total(), score=Math.floor((st.dmg+this.s.lv*2)*20+(10-st.ac)*10+(this.s.growth.pvp||0)*200);
    const ranks=['肯恩','絲莉安','甘特','卡士柏','伊娃','潘朵拉','哈汀','丹特斯'];
    return this.hero('競技場 / 排行榜','PVP 挑戰、排名與戰力摘要。','<button data-act="pvp" class="gold">挑戰競技場</button>')+this.statCards([['PVP 評分',f(score),'gold'],['競技訓練','Lv.'+(this.s.growth.pvp||0),'purple'],['鑽石',f(this.s.diamond),'cyan']])+`<div class="rank-list">${ranks.map((n,i)=>`<div class="rank-row"><b>#${i+1}</b><span>${n}</span><em>戰力 ${f(95000-i*7200+(i?0:score))}</em></div>`).join('')}</div>`;
  };

  Game.viewShop=function(){
    const goods=[['leaf_box','葉子補給','補充葉子，提升狩獵收益'],['scroll_bless_weapon','祝福武器卷','武器強化用'],['scroll_bless_armor','祝福防具卷','防具強化用'],['potion_clear','高級恢復藥水','自動狩獵補給']];
    return this.hero('商城 / 補給','鑽石消耗、補給用途與快速購買。')+this.statCards([['鑽石',f(this.s.diamond),'cyan'],['商品',goods.length,'gold'],['商城次數',this.s.daily.shop??'∞','green']])+`<div class="shop-grid">${goods.map(([id,n,desc])=>`<div class="card shop-card"><b>${esc(itemName(id)||n)}</b><p class="muted">${desc}</p><button data-act="buy" data-arg="${id}" ${this.s.diamond>=100?'':'disabled'}>購買 100 鑽</button></div>`).join('')}</div>`;
  };

  Game.viewAch=function(){
    const log=(this.s.diamondLog||[]).slice(0,20).map(x=>`<div class="mrow"><span>${new Date(x.t).toLocaleTimeString()}</span><span>${esc(x.reason)}</span><b class="cyan">+${x.n}</b></div>`).join('');
    return this.hero('成就 / 鑽石經濟','擊殺、Boss、抽卡、製作與鑽石來源彙整。')+this.statCards([['擊殺',f(this.s.ach.kills),'green','今日 '+(this.s.daily.kills||0)],['Boss',f(this.s.ach.boss),'red'],['抽卡',f(this.s.ach.draw),'purple'],['製作',f(this.s.ach.craft),'gold'],['累計鑽石',f(this.s.ach.diamond||0),'cyan'],['任務鑽石',f(this.s.ach.dailyDiamond||0),'blue']])+`<div class="card"><b>最近鑽石取得紀錄</b><div class="market-table small">${log||'<p class="muted">尚無鑽石掉落紀錄</p>'}</div></div>`;
  };

  Game.viewSettings=function(){
    const s=this.s.settings;
    return this.hero('自動設定','所有自動狩獵相關設定集中管理。')+`<div class="settings-grid"><label class="setting-card"><span>HP 低於此比例自動喝水</span><input data-set="hpLimit" type="number" min="1" max="99" value="${s.hpLimit}"></label><label class="setting-card"><span>啟用自動喝水</span><input data-set="autoPotion" type="checkbox" ${s.autoPotion?'checked':''}></label><label class="setting-card"><span>自動買水</span><input data-set="autoBuy" type="checkbox" ${s.autoBuy?'checked':''}></label><label class="setting-card"><span>自動挑戰野外 Boss</span><input data-set="autoBoss" type="checkbox" ${s.autoBoss?'checked':''}></label><label class="setting-card"><span>自動販售一般裝備</span><input data-set="autoSell" type="checkbox" ${s.autoSell?'checked':''}></label></div><div class="card"><button data-act="saveNow" class="blue">立即儲存</button> <button data-act="resetViewFilters">重置頁面篩選</button></div>`;
  };

  Game.viewAudit=function(){
    const items=Object.values(DB.item), mats=items.filter(i=>i.type==='material'), recipes=Object.keys(DB.recipes||{}); const miss=DB.maps.flatMap(m=>(m.drops||[]).filter(id=>!DB.item[id]).map(id=>m.name+':'+id));
    const pages=['總覽','裝備','背包','狩獵','技能','抽卡','變身/娃娃','合成','收藏','副本','世界王','血盟','製作','交易所','成長','競技場','商城','成就','設定'];
    return this.hero('完整度檢查','V21：所有主要頁面已統一卡片化、篩選化與狀態摘要。')+this.statCards([['職業',Object.keys(DB.classes).length,'gold'],['地圖',DB.maps.length,'blue'],['怪物',new Set(DB.maps.flatMap(m=>m.mons)).size,'red'],['道具',items.length,'gold'],['材料',mats.length,'green'],['配方',recipes.length,'purple'],['技能',Object.keys(DB.skills).length,'cyan'],['頁面優化',pages.length+'/'+pages.length,'green']])+`<div class="card"><b>${miss.length?'資料關聯仍有缺漏':'資料關聯檢查通過'}</b><br><span class="muted">掉落表缺失：${miss.length?miss.join('、'):'無'}<br>已優化頁面：${pages.join('、')}</span></div>`;
  };

  const oldActionV21=Game.action;
  Game.action=function(a,arg,b){
    if(a==='goMap'){this.s.map=arg;this.s.mon=null;this.render();return;}
    if(a==='craftFilter'){this.pageState.craftFilter=arg;this.renderTab();return;}
    if(a==='marketFilter'){this.pageState.marketFilter=arg;this.renderTab();return;}
    if(a==='saveNow'){this.save(true);return;}
    if(a==='resetViewFilters'){this.pageState={};this.render();return;}
    return oldActionV21.call(this,a,arg,b);
  };
  const css=document.createElement('style');
  css.textContent=`
    .page-hero{display:flex;justify-content:space-between;align-items:flex-start;gap:12px;margin-bottom:12px;background:linear-gradient(135deg,#101b2e,#07101d);border:1px solid #2c3d58;border-radius:14px;padding:14px}.page-hero h3{margin:0 0 4px}.hero-actions{display:flex;gap:6px;flex-wrap:wrap;justify-content:flex-end}.page-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:10px;margin:10px 0}.metric-card{background:#081120;border:1px solid #293a54;border-radius:13px;padding:12px;min-height:86px}.metric-card span{display:block;color:var(--muted);font-size:12px}.metric-card b{display:block;font-size:26px;margin-top:4px}.metric-card small{color:var(--muted);font-size:12px}.two-col{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:10px}.page-list{display:grid;gap:10px}.list-card{background:#081120;border:1px solid #26364e;border-radius:13px;padding:12px}.list-card.active,.list-card.done{border-color:var(--gold);background:#16180d}.boss-card{border-color:#4c1d1d}.drop-box,.pill-row{display:flex;flex-wrap:wrap;gap:6px;margin-top:8px}.page-tabs{margin:10px 0}.shop-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:10px}.shop-card{display:flex;flex-direction:column;gap:8px}.rank-bar{display:flex;gap:14px;flex-wrap:wrap;margin-top:8px}.market-table{display:grid;gap:6px}.mrow{display:grid;grid-template-columns:1.4fr 1fr 1fr .7fr;gap:8px;align-items:center;background:#07101d;border:1px solid #26364e;border-radius:10px;padding:8px}.mrow.head{background:#111c30;color:var(--gold);font-weight:800}.market-table.small .mrow{grid-template-columns:120px 1fr 70px}.rank-list{display:grid;gap:8px}.rank-row{display:grid;grid-template-columns:60px 1fr auto;gap:10px;background:#081120;border:1px solid #26364e;border-radius:12px;padding:10px}.rank-row em{font-style:normal;color:var(--muted)}.settings-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:10px}.setting-card{display:flex;align-items:center;justify-content:space-between;gap:10px;background:#081120;border:1px solid #26364e;border-radius:12px;padding:12px}.setting-card input[type=number]{width:90px}.progress-list p{margin:6px 0}@media(max-width:760px){.page-hero{display:block}.hero-actions{justify-content:flex-start;margin-top:10px}.mrow{grid-template-columns:1fr}.rank-row{grid-template-columns:45px 1fr}.combine-row{grid-template-columns:1fr!important}}`;
  document.head.appendChild(css);
})();



(function(){
  const esc=s=>String(s??'').replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
  const rankName={N:'一般',R:'高級',SR:'稀有',SSR:'英雄',L:'傳說',M:'神話'};
  const rankVal={N:1,R:2,SR:3,SSR:4,L:5,M:6};
  const shopType={daily:'每日',supply:'補給',scroll:'卷軸',material:'材料',card:'變身/娃娃',special:'特殊'};
  const itemName=id=>DB.item[id]?.name||DB.cards[id]?.name||id;
  const fmt=n=>Math.floor(n||0).toLocaleString();
  const ensureItem=(id,o)=>{ DB.item[id]=Object.assign({id,type:'material',rank:'N',price:100},DB.item[id]||{},o); };

  document.title='天堂M Core Rebuild V23｜全系統完善版';
  const titleEl=document.querySelector('.top .title'); if(titleEl) titleEl.textContent='天堂M Core Rebuild V23｜全系統完善版';

  // V22：補足商城、卡片分解與祝福粉末相關道具
  ensureItem('m18_powder',{name:'祝福粉末',type:'material',rank:'R',price:650,group:'魔法材料',desc:'卡片分解、裝備製作、祝福加工的核心材料'});
  ensureItem('v22_dragon_pearl',{name:'龍之珍珠',type:'box',rank:'R',price:2500,desc:'提升狩獵效率的消耗品'});
  ensureItem('v22_dragon_diamond',{name:'龍之鑽石',type:'box',rank:'SR',price:12000,desc:'補充殷海薩與成長資源'});
  ensureItem('v22_growth_potion',{name:'成長藥水',type:'box',rank:'SR',price:15000,desc:'獲得經驗值與少量葉子'});
  ensureItem('v22_daily_box',{name:'每日補給箱',type:'box',rank:'R',price:8000,desc:'紅水、葉子、少量祝福粉末'});
  ensureItem('v22_powder_box',{name:'祝福粉末箱',type:'box',rank:'SR',price:18000,desc:'開啟可取得祝福粉末'});
  ensureItem('v22_card_coin',{name:'卡片製作硬幣',type:'material',rank:'R',price:1200,group:'卡片材料',desc:'製作變身/娃娃卡片的材料'});
  ensureItem('v22_skill_coin',{name:'技能製作硬幣',type:'material',rank:'SR',price:2200,group:'技能材料',desc:'製作技能書與覺醒材料'});
  ensureItem('v22_tj_coupon',{name:'TJ優惠券碎片',type:'material',rank:'SSR',price:8000,group:'活動材料',desc:'活動與高階Boss產出'});

  // 補上地圖掉落：祝福粉末、卡片硬幣、技能硬幣依區域等級增加
  const low=['talking','mlc','windawood','gludin'];
  const mid=['giran','elf_forest','heine','eva','pirate'];
  const high=['dragon','dvc1','dvc2','toi','toi1','toi2','toi3','toi4','lastabad','lastabad2','oman','forgotten','hell','antharas','valakas'];
  DB.maps.forEach(m=>{
    m.materialDrops=m.materialDrops||[]; m.drops=m.drops||[];
    const add=id=>{ if(DB.item[id]&&!m.materialDrops.includes(id))m.materialDrops.push(id); if(DB.item[id]&&!m.drops.includes(id))m.drops.push(id); };
    if(low.includes(m.id)){ add('m18_powder'); }
    if(mid.includes(m.id)){ add('m18_powder'); add('v22_card_coin'); }
    if(high.includes(m.id)){ add('m18_powder'); add('v22_card_coin'); add('v22_skill_coin'); }
    if(m.max>=90){ add('v22_tj_coupon'); }
  });

  DB.shopV22=[
    {id:'potion_red',cat:'supply',price:120,currency:'adena',qty:100,limit:0,desc:'紅水 ×100，自動狩獵基礎補給'},
    {id:'potion_orange',cat:'supply',price:1500,currency:'adena',qty:30,limit:0,desc:'橙水 ×30，中期地圖補給'},
    {id:'potion_clear',cat:'supply',price:80,currency:'diamond',qty:20,limit:10,desc:'白水 ×20，高階地圖補給'},
    {id:'leaf_box',cat:'daily',price:120,currency:'diamond',qty:1,limit:5,desc:'殷海薩葉子補充箱'},
    {id:'v22_daily_box',cat:'daily',price:300,currency:'diamond',qty:1,limit:1,desc:'每日限購，內含補給與祝福粉末'},
    {id:'v22_dragon_pearl',cat:'supply',price:80,currency:'diamond',qty:3,limit:10,desc:'龍之珍珠 ×3'},
    {id:'v22_dragon_diamond',cat:'daily',price:350,currency:'diamond',qty:1,limit:3,desc:'龍之鑽石'},
    {id:'v22_growth_potion',cat:'daily',price:500,currency:'diamond',qty:1,limit:2,desc:'成長藥水'},
    {id:'scroll_weapon',cat:'scroll',price:90000,currency:'adena',qty:1,limit:0,desc:'武器強化卷軸'},
    {id:'scroll_armor',cat:'scroll',price:45000,currency:'adena',qty:1,limit:0,desc:'防具強化卷軸'},
    {id:'scroll_bless_weapon',cat:'scroll',price:550,currency:'diamond',qty:1,limit:5,desc:'祝福武器強化卷軸'},
    {id:'scroll_bless_armor',cat:'scroll',price:320,currency:'diamond',qty:1,limit:5,desc:'祝福防具強化卷軸'},
    {id:'scroll_accessory',cat:'scroll',price:220,currency:'diamond',qty:1,limit:5,desc:'飾品強化卷軸'},
    {id:'m18_powder',cat:'material',price:60,currency:'diamond',qty:10,limit:20,desc:'祝福粉末 ×10'},
    {id:'v22_powder_box',cat:'material',price:450,currency:'diamond',qty:1,limit:5,desc:'祝福粉末箱'},
    {id:'v22_card_coin',cat:'material',price:90,currency:'diamond',qty:10,limit:20,desc:'卡片製作硬幣 ×10'},
    {id:'v22_skill_coin',cat:'material',price:180,currency:'diamond',qty:5,limit:10,desc:'技能製作硬幣 ×5'},
    {id:'transform_draw_1',cat:'card',price:120,currency:'diamond',qty:1,limit:0,desc:'變身抽卡 1 次',virtual:true,act:'drawT'},
    {id:'transform_draw_11',cat:'card',price:1200,currency:'diamond',qty:1,limit:0,desc:'變身抽卡 11 次',virtual:true,act:'drawT11'},
    {id:'doll_draw_1',cat:'card',price:100,currency:'diamond',qty:1,limit:0,desc:'魔法娃娃抽卡 1 次',virtual:true,act:'drawD'},
    {id:'doll_draw_11',cat:'card',price:1000,currency:'diamond',qty:1,limit:0,desc:'魔法娃娃抽卡 11 次',virtual:true,act:'drawD11'},
    {id:'v22_tj_coupon',cat:'special',price:900,currency:'diamond',qty:1,limit:3,desc:'TJ優惠券碎片'},
    {id:'m18_hero_scroll_piece',cat:'special',price:1200,currency:'diamond',qty:1,limit:2,desc:'英雄製作秘笈碎片'},
    {id:'m18_legend_scroll_piece',cat:'special',price:5000,currency:'diamond',qty:1,limit:1,desc:'傳說製作秘笈碎片'}
  ];

  const oldEnsureV22=Game.ensure;
  Game.ensure=function(){
    oldEnsureV22.call(this);
    this.s.shopBought=this.s.shopBought||{};
    this.s.daily=Object.assign({shop:10},this.s.daily||{});
  };
  Game.countItem=Game.countItem||function(id){return Object.values(this.s.inv||{}).filter(x=>x.id===id).reduce((a,x)=>a+(x.qty||0),0)};
  Game.itemDisplay=function(id){return itemName(id);};

  Game.openBoxV22=function(id){
    if(id==='v22_daily_box'){this.addItem('potion_red',150);this.addItem('leaf_box',1);this.addItem('m18_powder',this.rand(5,15));return '開啟每日補給箱';}
    if(id==='v22_powder_box'){this.addItem('m18_powder',this.rand(30,80));return '開啟祝福粉末箱';}
    if(id==='v22_dragon_diamond'){this.s.leaf=Math.min(200,(this.s.leaf||0)+80);this.s.exp+=this.need()*0.03;return '使用龍之鑽石，葉子與經驗增加';}
    if(id==='v22_growth_potion'){this.s.exp+=this.need()*0.08;this.s.leaf=Math.min(200,(this.s.leaf||0)+30);this.level();return '使用成長藥水，取得經驗值';}
    if(id==='v22_dragon_pearl'){this.s.leaf=Math.min(200,(this.s.leaf||0)+10);return '使用龍之珍珠，狩獵效率提升';}
    return null;
  };
  const oldUseV22=Game.use;
  Game.use=function(k){
    const it=this.inv(k), d=this.def(it?.id); if(!it||!d) return;
    const msg=this.openBoxV22(d.id);
    if(msg){this.rem(k,1);this.log(msg,'green');this.render();return;}
    return oldUseV22.call(this,k);
  };

  Game.buyShop=function(gid){
    const g=DB.shopV22.find(x=>x.id===gid); if(!g) return;
    this.s.shopBought=this.s.shopBought||{};
    const bought=this.s.shopBought[gid]||0;
    if(g.limit && bought>=g.limit){alert('今日限購已達上限');return;}
    if((this.s[g.currency]||0)<g.price){alert((g.currency==='diamond'?'鑽石':'金幣')+'不足');return;}
    this.s[g.currency]-=g.price; this.s.shopBought[gid]=bought+1;
    if(g.virtual){
      if(g.act==='drawT')this.draw('transform',1);
      if(g.act==='drawT11')this.draw('transform',11);
      if(g.act==='drawD')this.draw('doll',1);
      if(g.act==='drawD11')this.draw('doll',11);
      this.log('商城購買：'+g.desc,'green'); return;
    }
    this.addItem(g.id,g.qty||1,0);
    this.log(`商城購買：${itemName(g.id)} ×${g.qty||1}`,'green'); this.render();
  };

  Game.powderByRank=function(rank){ return {N:1,R:3,SR:10,SSR:50,L:300,M:3000}[rank]||1; };
  Game.disassembleCard=function(id,keepOne=true){
    const c=DB.cards[id]; if(!c) return;
    const qty=this.s.cards[id]||0;
    const min=keepOne?1:0;
    if(qty<=min){alert(keepOne?'至少保留 1 張，沒有可分解的重複卡':'沒有可分解卡片');return;}
    this.s.cards[id]=qty-1;
    const powder=this.powderByRank(c.rank);
    this.addItem('m18_powder',powder);
    this.log(`卡片分解：${c.name} → 祝福粉末 ×${powder}`,'green');
    this.render();
  };
  Game.disassembleAllDuplicateCards=function(){
    let total=0, count=0;
    Object.values(DB.cards).forEach(c=>{
      const qty=this.s.cards[c.id]||0, n=Math.max(0,qty-1);
      if(n>0){this.s.cards[c.id]=1;count+=n;total+=n*this.powderByRank(c.rank);}
    });
    if(!count){alert('沒有重複卡片可分解');return;}
    this.addItem('m18_powder',total);
    this.log(`批次分解重複卡 ${count} 張，取得祝福粉末 ×${total}`,'green');
    this.render();
  };

  const oldKillV22=Game.kill;
  Game.kill=function(m,bonus){
    const map=this.map();
    oldKillV22.call(this,m,bonus);
    // V22 追加材料掉落層：祝福粉末與商店材料可以從怪物取得，避免只靠商城。
    let rate=m.boss?0.85:0.18;
    if(map.min>=50) rate+=0.08;
    if(map.min>=75) rate+=0.12;
    if(Math.random()<rate){
      const pool=(map.materialDrops||[]).filter(id=>DB.item[id]);
      if(pool.length){
        const id=pool[this.rand(0,pool.length-1)], d=DB.item[id];
        const qty=m.boss?this.rand(3,12):(d.rank==='SSR'||d.rank==='L'?1:this.rand(1,3));
        this.addItem(id,qty); this.log(`V22材料掉落：${d.name} ×${qty}`,'green');
      }
    }
  };

  const oldViewCardsV22=Game.viewCards;
  Game.viewCards=function(){
    let html=oldViewCardsV22.call(this);
    html=html.replace('<button data-act="bestCards" class="gold">一鍵套用最佳</button>','<button data-act="bestCards" class="gold">一鍵套用最佳</button> <button data-act="disAllDupCards">分解所有重複卡</button>');
    html=html.replace(/(<button data-act="active" data-arg="([^"]+)">啟用<\/button>)/g,(m,btn,id)=>`${btn} <button data-act="disCard" data-arg="${id}">分解重複</button>`);
    html+=`<div class="card" style="margin-top:10px"><b class="gold">V22 卡片分解</b><br><span class="muted">一般 1、 高級 3、稀有 10、英雄 50、傳說 300、神話 3000 祝福粉末。預設保留每張卡至少 1 張，避免誤拆收藏。</span></div>`;
    return html;
  };

  Game.shopSummary=function(){
    const bought=this.s.shopBought||{};
    return DB.shopV22.reduce((a,g)=>{a.total++;a[g.cat]=(a[g.cat]||0)+1;if(g.limit)a.limited++; if((bought[g.id]||0)>0)a.bought++; return a;},{total:0,limited:0,bought:0});
  };
  Game.viewShop=function(){
    const filter=this.pageState.shopFilter||'all';
    const cats=[['all','全部'],['daily','每日'],['supply','補給'],['scroll','卷軸'],['material','材料'],['card','變身/娃娃'],['special','特殊']];
    const list=DB.shopV22.filter(g=>filter==='all'||g.cat===filter);
    const s=this.shopSummary();
    const cards=list.map(g=>{
      const bought=(this.s.shopBought||{})[g.id]||0, left=g.limit?Math.max(0,g.limit-bought):'不限';
      const cur=g.currency==='diamond'?'鑽石':'金幣', enough=(this.s[g.currency]||0)>=g.price;
      return `<div class="shop-v22-card"><div class="row"><div><b class="${g.currency==='diamond'?'cyan':'gold'}">${esc(g.virtual?g.desc:itemName(g.id))}</b><br><span class="muted">${shopType[g.cat]}｜${esc(g.desc)}｜限購 ${left}</span></div><span class="pill">${fmt(g.price)} ${cur}</span></div><div class="row" style="margin-top:10px"><span class="muted">數量：${g.qty||1}</span><button data-act="buyShop" data-arg="${esc(g.id)}" ${(!enough||(g.limit&&bought>=g.limit))?'disabled':''}>購買</button></div></div>`;
    }).join('');
    return this.hero('商城 V22','更新為分類商店：每日、補給、卷軸、材料、變身/娃娃、特殊商品。')+
      this.statCards([['鑽石',fmt(this.s.diamond),'cyan'],['金幣',fmt(this.s.adena),'gold'],['商品',s.total,'green'],['限購商品',s.limited,'purple'],['已購買',s.bought,'blue'],['祝福粉末',fmt(this.countItem('m18_powder')),'gold']])+
      `<div class="tabs page-tabs">${cats.map(([id,n])=>`<button class="tab ${filter===id?'on':''}" data-act="shopFilter" data-arg="${id}">${n}</button>`).join('')}</div><div class="shop-v22-grid">${cards}</div>`+
      `<div class="card"><b class="gold">V22 祝福粉末取得</b><br><span class="muted">來源：怪物材料掉落、Boss 額外掉落、卡片分解、祝福粉末箱、每日補給箱。用途：卡片製作、裝備製作、後續覺醒與祝福加工。</span></div>`;
  };

  const oldViewCraftV22=Game.viewCraft;
  Game.viewCraft=function(){
    let html=oldViewCraftV22.call(this);
    html=html.replace('V21：所有主要頁面已統一卡片化、篩選化與狀態摘要。','V22：製作材料、怪物掉落、商城與卡片分解已整合。');
    return html;
  };

  const oldViewAuditV22=Game.viewAudit;
  Game.viewAudit=function(){
    const html=oldViewAuditV22.call(this);
    return html.replace('V21：所有主要頁面已統一卡片化、篩選化與狀態摘要。','V22：新增商店分類、限購、卡片分解、祝福粉末掉落與材料經濟。')+
      `<div class="card"><b class="gold">V22 新增檢查</b><br><span class="muted">商城商品 ${DB.shopV22.length} 項｜祝福粉末持有 ${this.countItem('m18_powder')}｜可掉落祝福粉末地圖 ${DB.maps.filter(m=>(m.materialDrops||[]).includes('m18_powder')).length} 張｜卡片分解系統：已啟用</span></div>`;
  };

  const oldActionV22=Game.action;
  Game.action=function(a,arg,b){
    if(a==='shopFilter'){this.pageState.shopFilter=arg||'all';this.renderTab();return;}
    if(a==='buyShop'){this.buyShop(arg);return;}
    if(a==='disCard'){this.disassembleCard(arg,true);return;}
    if(a==='disAllDupCards'){this.disassembleAllDuplicateCards();return;}
    return oldActionV22.call(this,a,arg,b);
  };

  const css=document.createElement('style');
  css.textContent=`
    .shop-v22-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(270px,1fr));gap:10px;margin:10px 0}.shop-v22-card{background:#081120;border:1px solid #293a54;border-radius:14px;padding:12px;min-height:132px}.shop-v22-card:hover{border-color:#64748b}.shop-v22-card .pill{white-space:nowrap}.shop-v22-card button:disabled{opacity:.45}.card-tile button[data-act=disCard]{margin-left:4px}.shop-v22-grid+.card{margin-top:10px}`;
  document.head.appendChild(css);
})();


/* =========================
   V23 FULL SYSTEM EXPANSION
   ========================= */
(function(){
  document.title='天堂M Core Rebuild V23｜全系統完善版';
  const titleEl=document.querySelector('.top .title'); if(titleEl) titleEl.textContent='天堂M Core Rebuild V23｜全系統完善版';
  const $n = (v)=> (window.fmt?fmt(v):Math.floor(v||0).toLocaleString());
  const $e = (v)=> (window.esc?esc(v):String(v??'').replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m])));
  const rankName={N:'一般',R:'高級',SR:'稀有',SSR:'英雄',L:'傳說',M:'神話'};
  const rankCss=r=>`r-${r||'N'}`;
  function putItem(id,o){ DB.item[id]=Object.assign({id,type:'material',rank:'N',price:100},DB.item[id]||{},o); }
  function hasItem(id){return !!DB.item[id]}
  // 基礎材料、消耗品、覺醒與系統貨幣
  [
    ['v23_awake_stone','覺醒石','material','SSR',120000],['v23_trans_awake','變身覺醒石','material','SSR',150000],['v23_doll_awake','娃娃覺醒石','material','SSR',150000],['v23_relic_awake','聖物覺醒石','material','L',450000],
    ['v23_rune_stone','符石強化石','material','SR',80000],['v23_eye_stone','魔眼石','material','SR',65000],['v23_pattern_stone','紋樣石','material','SR',50000],['v23_holy_essence','聖劍精髓','material','SSR',180000],
    ['v23_elixir','萬能藥','elixir','L',1200000],['v23_elixir_piece','萬能藥碎片','material','SSR',90000],['v23_tj_coin','TJ憑證','material','SSR',100000],['v23_event_coin','活動硬幣','material','R',20000],
    ['v23_dragon_pearl','龍之珍珠','buff','R',50000],['v23_dragon_diamond','龍之鑽石','buff','SSR',250000],['v23_dragon_s_diamond','高級龍之鑽石','buff','L',650000],
    ['v23_skill_page','技能書頁','material','R',25000],['v23_rare_book_box','稀有技能書箱','box','SR',300000],['v23_hero_book_box','英雄技能書箱','box','SSR',1500000],['v23_legend_book_box','傳說技能書箱','box','L',8000000],
    ['v23_guild_key','血盟副本鑰匙','material','R',30000],['v23_boss_token','血盟Boss召喚石','material','SSR',200000],['v23_tj_restore','TJ復原券','coupon','SSR',0],['v23_tj_card','TJ卡片券','coupon','SSR',0],['v23_tj_enchant','TJ強化券','coupon','SSR',0]
  ].forEach(x=>putItem(x[0],{name:x[1],type:x[2],rank:x[3],price:x[4]}));
  // 補齊技能書道具
  if(DB.skills){Object.values(DB.skills).forEach(sk=>{ if(!hasItem('book_'+sk.id)) putItem('book_'+sk.id,{name:`技能書：${sk.name}`,type:'book',rank:sk.rank||'R',price:(sk.lv||1)*80000,bookSkill:sk.id}); });}
  // 套裝效果
  DB.setsV23=[
    {id:'dragon',name:'龍之守護套裝',items:['dragon_armor','dragon_ring','relic_dragon'],bonus:{dmg:10,dr:8,hp:300,mr:20}},
    {id:'mythic',name:'神話守護套裝',items:['mythic_excalibur','mythic_armor','mythic_earring'],bonus:{dmg:25,dr:18,hp:900,hit:12}},
    {id:'valakas',name:'火龍攻擊套裝',items:['valakas_sword','valakas_armor','dragon_rune_fire'],bonus:{dmg:22,str:4,spd:5}},
    {id:'antharas',name:'地龍防禦套裝',items:['antharas_greatsword','ant_helm','dragon_rune_earth'],bonus:{dr:16,con:4,hp:700}},
    {id:'lindvior',name:'風龍敏捷套裝',items:['lindvior_bow','lindvior_cloak','dragon_rune_wind'],bonus:{dex:6,hit:10,spd:12}}
  ];
  DB.cardBooksV23=[
    {id:'cb_dk',name:'死亡騎士收藏冊',cards:['t_dk','d_dk'],bonus:{dmg:5,hit:3}},
    {id:'cb_legend',name:'傳說降臨收藏冊',cards:['t_ken','d_lich'],bonus:{dmg:12,dr:5,mr:10}},
    {id:'cb_myth',name:'神話覺醒收藏冊',cards:['t_odin','d_dragon'],bonus:{dmg:25,dr:12,hp:600}},
    {id:'cb_basic',name:'亞丁冒險收藏冊',cards:['t_orc','t_skel','d_bug','d_spartoi'],bonus:{hp:120,mp:60}}
  ];
  DB.magicEyesV23=[
    {id:'earth',name:'地龍魔眼',bonus:{dr:3,hp:120}}, {id:'water',name:'水龍魔眼',bonus:{mr:8,mp:120}}, {id:'fire',name:'火龍魔眼',bonus:{dmg:4,str:1}}, {id:'wind',name:'風龍魔眼',bonus:{hit:3,dex:1,spd:2}}, {id:'birth',name:'誕生魔眼',bonus:{dmg:8,dr:5,hp:250}}
  ];
  DB.patternsV23=[
    {id:'str',name:'力量紋樣',stat:'str'}, {id:'dex',name:'敏捷紋樣',stat:'dex'}, {id:'int',name:'智力紋樣',stat:'int'}, {id:'wis',name:'精神紋樣',stat:'wis'}, {id:'con',name:'體質紋樣',stat:'con'}, {id:'guard',name:'守護紋樣',stat:'dr'}
  ];
  DB.holySwordV23=[
    {id:'blade',name:'聖劍鋒芒',bonusPer:{dmg:2,hit:1}}, {id:'guard',name:'聖劍守護',bonusPer:{dr:1,hp:35}}, {id:'faith',name:'聖劍信念',bonusPer:{mr:2,mp:25}}
  ];
  DB.eventsV23=[
    {id:'event_hunt',name:'亞丁狩獵祭',desc:'擊殺 100 隻怪物可領活動硬幣與祝福粉末。',need:'kills',goal:100,reward:{v23_event_coin:30,m18_powder:50}},
    {id:'event_boss',name:'世界王遠征',desc:'討伐 3 次 Boss 可領 TJ 憑證。',need:'boss',goal:3,reward:{v23_tj_coin:2,v23_boss_token:1}},
    {id:'event_card',name:'卡片成長支援',desc:'抽卡 20 次可領覺醒材料。',need:'draw',goal:20,reward:{v23_trans_awake:1,v23_doll_awake:1}}
  ];
  DB.guildBossV23=[
    {id:'gb1',name:'血盟巴風特',lv:45,cost:{v23_boss_token:1},reward:{m18_powder:[30,80],v23_event_coin:[10,20]}},
    {id:'gb2',name:'血盟死亡騎士',lv:60,cost:{v23_boss_token:2},reward:{v23_awake_stone:[1,2],m18_powder:[80,180]}},
    {id:'gb3',name:'血盟安塔瑞斯幻影',lv:80,cost:{v23_boss_token:4},reward:{v23_relic_awake:[1,1],v23_tj_coin:[1,3]}}
  ];
  DB.guildDungeonsV23=[
    {id:'gd1',name:'血盟訓練場',lv:20,cost:{v23_guild_key:1},reward:{adena:[50000,150000],v23_event_coin:[5,12]}},
    {id:'gd2',name:'血盟地下基地',lv:45,cost:{v23_guild_key:2},reward:{m18_powder:[20,60],v23_skill_page:[3,8]}},
    {id:'gd3',name:'血盟龍之試煉',lv:70,cost:{v23_guild_key:3},reward:{v23_boss_token:[1,2],v23_awake_stone:[1,2]}}
  ];
  // 商店 V23：保留 V22，新增系統商品
  DB.shopV23=(DB.shopV22||[]).concat([
    {id:'v23_dragon_pearl',cat:'buff',price:80,currency:'diamond',qty:3,limit:10,desc:'龍之珍珠 ×3'},
    {id:'v23_dragon_diamond',cat:'buff',price:300,currency:'diamond',qty:1,limit:5,desc:'龍之鑽石'},
    {id:'v23_dragon_s_diamond',cat:'buff',price:900,currency:'diamond',qty:1,limit:2,desc:'高級龍之鑽石'},
    {id:'v23_awake_stone',cat:'awake',price:500,currency:'diamond',qty:1,limit:10,desc:'通用覺醒石'},
    {id:'v23_trans_awake',cat:'awake',price:650,currency:'diamond',qty:1,limit:5,desc:'變身覺醒石'},
    {id:'v23_doll_awake',cat:'awake',price:650,currency:'diamond',qty:1,limit:5,desc:'娃娃覺醒石'},
    {id:'v23_relic_awake',cat:'awake',price:1500,currency:'diamond',qty:1,limit:2,desc:'聖物覺醒石'},
    {id:'v23_rune_stone',cat:'growth',price:220,currency:'diamond',qty:1,limit:10,desc:'符石強化石'},
    {id:'v23_eye_stone',cat:'growth',price:180,currency:'diamond',qty:1,limit:10,desc:'魔眼石'},
    {id:'v23_pattern_stone',cat:'growth',price:150,currency:'diamond',qty:3,limit:20,desc:'紋樣石 ×3'},
    {id:'v23_holy_essence',cat:'growth',price:480,currency:'diamond',qty:1,limit:10,desc:'聖劍精髓'},
    {id:'v23_elixir_piece',cat:'growth',price:360,currency:'diamond',qty:5,limit:10,desc:'萬能藥碎片 ×5'},
    {id:'v23_rare_book_box',cat:'book',price:450,currency:'diamond',qty:1,limit:5,desc:'稀有技能書箱'},
    {id:'v23_hero_book_box',cat:'book',price:2200,currency:'diamond',qty:1,limit:2,desc:'英雄技能書箱'},
    {id:'v23_legend_book_box',cat:'book',price:9900,currency:'diamond',qty:1,limit:1,desc:'傳說技能書箱'},
    {id:'v23_guild_key',cat:'guild',price:80000,currency:'adena',qty:1,limit:5,desc:'血盟副本鑰匙'},
    {id:'v23_boss_token',cat:'guild',price:500,currency:'diamond',qty:1,limit:5,desc:'血盟Boss召喚石'},
    {id:'v23_tj_restore',cat:'tj',price:0,currency:'v23_tj_coin',qty:1,limit:1,desc:'TJ復原券'},
    {id:'v23_tj_card',cat:'tj',price:0,currency:'v23_tj_coin',qty:1,limit:1,desc:'TJ卡片券'},
    {id:'v23_tj_enchant',cat:'tj',price:0,currency:'v23_tj_coin',qty:1,limit:1,desc:'TJ強化券'}
  ]);
  function itemCountIn(inv,id){return Object.values(inv||{}).filter(x=>x.id===id).reduce((a,x)=>a+(x.qty||0),0)}
  function addStats(a,b,mul=1){let r={...a}; Object.entries(b||{}).forEach(([k,v])=>{r[k]=(r[k]||0)+v*mul}); return r;}
  const oldEnsure=Game.ensure;
  Game.ensure=function(){
    oldEnsure.call(this); const s=this.s; s.version='core_rebuild_v23';
    s.v23=s.v23||{}; s.awake=s.awake||{transform:{},doll:{},relic:{}}; s.runePlus=s.runePlus||{}; s.magicEyes=s.magicEyes||{}; s.patterns=s.patterns||{}; s.holySword=s.holySword||{}; s.elixir=s.elixir||{str:0,dex:0,con:0,int:0,wis:0};
    s.codexMon=s.codexMon||{}; s.codexMap=s.codexMap||{}; s.codexBoss=s.codexBoss||{}; s.cardBook=s.cardBook||{}; s.guildV23=s.guildV23||{boss:3,dungeon:3}; s.signin=s.signin||{month:new Date().getMonth()+1,days:{}}; s.events=s.events||{}; s.tj=s.tj||{restore:1,card:1,enchant:1,history:[]}; s.red=s.red||{}; s.marketReal=s.marketReal||{}; s.buffs=s.buffs||{};
    s.daily=Object.assign({signin:1,guildBoss:3,guildDungeon:3,tjRestore:1,tjCard:1,tjEnchant:1},s.daily||{});
    if(!s.inv['v23_guild_key|0']) this.addItem('v23_guild_key',3);
    if(!s.inv['v23_boss_token|0']) this.addItem('v23_boss_token',1);
  };
  // 狀態總加成：套裝、收藏冊、覺醒、魔眼、紋樣、聖劍、萬能藥、Buff
  const oldTotal=Game.total;
  Game.total=function(){
    let st=oldTotal.call(this), s=this.s;
    Object.entries(s.elixir||{}).forEach(([k,v])=>{st[k]=(st[k]||0)+(v||0)});
    (DB.setsV23||[]).forEach(set=>{ if(set.items.every(id=>Object.values(s.equip||{}).some(k=>k && this.inv(k)?.id===id))) st=addStats(st,set.bonus); });
    (DB.cardBooksV23||[]).forEach(book=>{ if(s.cardBook?.[book.id]) st=addStats(st,book.bonus); });
    ['transform','doll'].forEach(kind=>Object.entries(s.awake?.[kind]||{}).forEach(([id,lv])=>{let c=DB.cards[id]; if(c&&lv>0){st.dmg=(st.dmg||0)+lv*(c.rank==='M'?8:c.rank==='L'?5:2); st.hit=(st.hit||0)+lv*2; st.hp=(st.hp||0)+lv*30;}}));
    Object.entries(s.awake?.relic||{}).forEach(([id,lv])=>{ if(lv>0){st.dmg=(st.dmg||0)+lv*4; st.dr=(st.dr||0)+lv*3; st.mr=(st.mr||0)+lv*5;} });
    Object.entries(s.runePlus||{}).forEach(([id,lv])=>{st.dmg=(st.dmg||0)+lv; st.dr=(st.dr||0)+Math.floor(lv/2);});
    (DB.magicEyesV23||[]).forEach(e=>{let lv=s.magicEyes[e.id]||0; if(lv) st=addStats(st,e.bonus,lv);});
    (DB.patternsV23||[]).forEach(p=>{let lv=s.patterns[p.id]||0; if(lv){st[p.stat]=(st[p.stat]||0)+(p.stat==='dr'?Math.floor(lv/2):lv);}});
    (DB.holySwordV23||[]).forEach(h=>{let lv=s.holySword[h.id]||0; if(lv) st=addStats(st,h.bonusPer,lv);});
    if((s.buffs?.pearl||0)>Date.now()) st.spd=(st.spd||0)+15;
    if((s.buffs?.dragonDiamond||0)>Date.now()){st.dmg=(st.dmg||0)+5; st.hit=(st.hit||0)+5;}
    return st;
  };
  // 圖鑑記錄與技能書掉落
  const oldSpawn=Game.spawn;
  Game.spawn=function(){ oldSpawn.call(this); const m=this.s.mon, map=this.map(); if(m){m.map=map.id; this.s.codexMap[map.id]=(this.s.codexMap[map.id]||0)+1;} };
  const oldKill=Game.kill;
  Game.kill=function(m,bonus){
    const map=this.map(); oldKill.call(this,m,bonus);
    this.s.codexMon[m.name]=(this.s.codexMon[m.name]||0)+1; if(m.boss)this.s.codexBoss[m.name]=(this.s.codexBoss[m.name]||0)+1;
    const high=map.min>=70, boss=m.boss; const rate=boss?.32:(high?.08:.025);
    if(DB.skills && Math.random()<rate){
      let pool=Object.values(DB.skills).filter(sk=>sk.cls==='all'||sk.cls===this.s.cls); if(!pool.length) pool=Object.values(DB.skills);
      let sk=pool[this.rand(0,pool.length-1)]; this.addItem('book_'+sk.id,1); this.log(`技能書掉落：${sk.name}`,'green');
    }
    if(Math.random()<(boss?.18:.04)){this.addItem('v23_event_coin',this.rand(1,boss?8:2));}
    if(Math.random()<(boss?.12:.025)){this.addItem('v23_skill_page',this.rand(1,boss?5:2));}
    this.checkV23Red();
  };
  const oldBoss=Game.boss;
  Game.boss=function(id){ const b=(DB.bosses||[]).find(x=>x.id===id); oldBoss.call(this,id); if(b){this.s.codexBoss[b.name]=(this.s.codexBoss[b.name]||0)+1; this.addItem('v23_boss_token',Math.random()<.35?1:0); this.checkV23Red();} };
  // Buff/箱子/萬能藥
  const oldUse=Game.use;
  Game.use=function(k){
    const it=this.inv(k), d=this.def(it?.id); if(!it||!d) return;
    const now=Date.now();
    if(d.id==='v23_dragon_pearl'){this.s.buffs.pearl=now+30*60*1000; this.rem(k,1); this.log('使用龍之珍珠：30分鐘狩獵速度提升','green'); this.render(); return;}
    if(d.id==='v23_dragon_diamond'){this.s.buffs.dragonDiamond=now+30*60*1000; this.s.leaf=Math.min(200,(this.s.leaf||0)+100); this.rem(k,1); this.log('使用龍之鑽石：葉子補充並提升戰力','green'); this.render(); return;}
    if(d.id==='v23_dragon_s_diamond'){this.s.buffs.dragonDiamond=now+60*60*1000; this.s.leaf=200; this.s.exp+=this.need()*0.15; this.rem(k,1); this.level(); this.log('使用高級龍之鑽石：葉子補滿並取得大量經驗','green'); this.render(); return;}
    if(d.id==='v23_elixir'){this.pendingElixir=true; this.log('請到「萬能藥」頁面選擇能力使用','gold'); this.render(); return;}
    if(d.id==='v23_rare_book_box'||d.id==='v23_hero_book_box'||d.id==='v23_legend_book_box'){
      const target=d.id.includes('legend')?'L':d.id.includes('hero')?'SSR':'SR'; let pool=Object.values(DB.skills||{}).filter(sk=>(sk.rank||'R')===target && (sk.cls==='all'||sk.cls===this.s.cls)); if(!pool.length) pool=Object.values(DB.skills||{});
      const sk=pool[this.rand(0,pool.length-1)]; if(sk){this.addItem('book_'+sk.id,1); this.log(`開啟技能書箱：${sk.name}`,'green');}
      this.rem(k,1); this.render(); return;
    }
    return oldUse.call(this,k);
  };
  // V23 Tabs
  Game.tabs=function(){
    const red=this.redDots?this.redDots():{};
    let t=[['dash','總覽'],['equip','裝備'],['bag','背包'],['hunt','狩獵'],['skills','技能'],['draw','抽卡'],['cards','變身/娃娃'],['combine','合成'],['cardBook','卡片收藏冊'],['awake','覺醒'],['codex','收藏'],['monsterBook','怪物圖鑑'],['mapBook','地圖圖鑑'],['bossBook','BOSS圖鑑'],['dungeon','副本'],['boss','世界王'],['guild','血盟'],['guildRaid','血盟副本/Boss'],['craft','製作'],['market','交易所'],['growth','成長'],['v23Growth','魔眼/紋樣/聖劍'],['elixir','萬能藥'],['pvp','競技場'],['shop','商城'],['signin','每日簽到'],['events','活動'],['tj','TJ系統'],['ach','成就'],['audit','完整度檢查'],['settings','自動設定']];
    this.$('tabs').innerHTML=t.map(x=>`<button class="tab" data-tab="${x[0]}">${x[1]}${red[x[0]]?'<span class="red-dot"></span>':''}</button>`).join('');
    this.$('tabs').querySelectorAll('.tab').forEach(b=>b.onclick=()=>{this.tab=b.dataset.tab;this.renderTab()});
  };
  const oldRenderTab=Game.renderTab;
  Game.renderTab=function(){
    const map={cardBook:'viewCardBookV23',awake:'viewAwakeV23',monsterBook:'viewMonsterBookV23',mapBook:'viewMapBookV23',bossBook:'viewBossBookV23',guildRaid:'viewGuildRaidV23',v23Growth:'viewV23Growth',elixir:'viewElixirV23',signin:'viewSigninV23',events:'viewEventsV23',tj:'viewTJV23'};
    if(map[this.tab]){document.querySelectorAll('.tab').forEach(b=>b.classList.toggle('on',b.dataset.tab==this.tab)); this.$('content').innerHTML=this[map[this.tab]](); return;}
    return oldRenderTab.call(this);
  };
  Game.redDots=function(){
    const s=this.s||{}, r={};
    if(itemCountIn(s.inv,'v23_trans_awake')||itemCountIn(s.inv,'v23_doll_awake')||itemCountIn(s.inv,'v23_relic_awake')) r.awake=1;
    if((s.daily?.signin||0)>0) r.signin=1;
    if((s.daily?.tjRestore||0)>0||(s.daily?.tjCard||0)>0||(s.daily?.tjEnchant||0)>0) r.tj=1;
    if(Object.values(s.cards||{}).some(q=>q>1)) r.cards=1;
    if((DB.cardBooksV23||[]).some(b=>!s.cardBook?.[b.id]&&b.cards.every(id=>(s.cards||{})[id]>0))) r.cardBook=1;
    if((DB.eventsV23||[]).some(ev=>!s.events?.[ev.id] && this.eventProgress(ev)>=ev.goal)) r.events=1;
    return r;
  };
  Game.checkV23Red=function(){this.s.red=this.redDots();};
  // Views
  Game.cardBookReady=function(book){return book.cards.every(id=>(this.s.cards||{})[id]>0)};
  Game.viewCardBookV23=function(){
    const rows=DB.cardBooksV23.map(b=>{let ready=this.cardBookReady(b), done=this.s.cardBook[b.id]; return `<div class="list-card ${done?'done':''}"><div class="row"><div><b class="gold">${$e(b.name)}</b> ${done?'<span class="green">已登錄</span>':ready?'<span class="red-badge">可登錄</span>':''}<br><span class="muted">需求：${b.cards.map(id=>DB.cards[id]?.name||id).join('、')}｜加成：${Object.entries(b.bonus).map(x=>x.join('+')).join('、')}</span></div><button data-act="cardBookReg" data-arg="${b.id}" ${ready&&!done?'':'disabled'}>登錄</button></div></div>`}).join('');
    return this.hero('卡片收藏冊','變身與娃娃卡片收藏冊，登錄後提供永久能力。')+this.statCards([['收藏冊',DB.cardBooksV23.length,'gold'],['已完成',Object.values(this.s.cardBook).filter(Boolean).length,'green'],['可登錄',DB.cardBooksV23.filter(b=>this.cardBookReady(b)&&!this.s.cardBook[b.id]).length,'red']])+`<div class="page-list">${rows}</div>`;
  };
  Game.viewAwakeV23=function(){
    const ownedCards=Object.values(DB.cards).filter(c=>(this.s.cards[c.id]||0)>0);
    const cardRows=ownedCards.map(c=>{let kind=c.kind, lv=this.s.awake[kind]?.[c.id]||0, need=kind==='transform'?'v23_trans_awake':'v23_doll_awake'; return `<div class="list-card"><div class="row"><div><b class="${rankCss(c.rank)}">${kind==='transform'?'變身':'娃娃'}｜${$e(c.name)}</b><br><span class="muted">覺醒 Lv.${lv}/5｜消耗 ${DB.item[need].name}、祝福粉末</span></div><button data-act="awakeCard" data-arg="${kind}|${c.id}" ${itemCountIn(this.s.inv,need)>0&&itemCountIn(this.s.inv,'m18_powder')>=50*(lv+1)&&lv<5?'':'disabled'}>覺醒</button></div></div>`}).join('');
    const relics=Object.values(this.s.inv||{}).filter(x=>this.def(x.id)?.type==='relic').map(x=>this.def(x.id)).filter((v,i,a)=>a.findIndex(z=>z.id===v.id)===i);
    const relicRows=relics.map(d=>{let lv=this.s.awake.relic?.[d.id]||0; return `<div class="list-card"><div class="row"><div><b class="${rankCss(d.rank)}">${$e(d.name)}</b><br><span class="muted">聖物覺醒 Lv.${lv}/5｜增加傷害、減傷、魔防</span></div><button data-act="awakeRelic" data-arg="${d.id}" ${itemCountIn(this.s.inv,'v23_relic_awake')>0&&itemCountIn(this.s.inv,'m18_powder')>=120*(lv+1)&&lv<5?'':'disabled'}>覺醒</button></div></div>`}).join('')||'<p class="muted">背包沒有聖物</p>';
    return this.hero('變身 / 娃娃 / 聖物覺醒','消耗覺醒石與祝福粉末，直接接入角色能力計算。')+this.statCards([['變身覺醒石',itemCountIn(this.s.inv,'v23_trans_awake'),'gold'],['娃娃覺醒石',itemCountIn(this.s.inv,'v23_doll_awake'),'purple'],['聖物覺醒石',itemCountIn(this.s.inv,'v23_relic_awake'),'red'],['祝福粉末',itemCountIn(this.s.inv,'m18_powder'),'cyan']])+`<h4 class="title">卡片覺醒</h4><div class="page-list">${cardRows||'<p class="muted">尚未取得卡片</p>'}</div><h4 class="title">聖物覺醒</h4><div class="page-list">${relicRows}</div>`;
  };
  Game.viewV23Growth=function(){
    const eyes=DB.magicEyesV23.map(e=>{let lv=this.s.magicEyes[e.id]||0; return `<div class="list-card"><div class="row"><div><b>${e.name}</b> Lv.${lv}/10<br><span class="muted">加成：${Object.entries(e.bonus).map(([k,v])=>`${k}+${v}/級`).join('、')}</span></div><button data-act="upEye" data-arg="${e.id}" ${itemCountIn(this.s.inv,'v23_eye_stone')>=lv+1&&lv<10?'':'disabled'}>升級</button></div></div>`}).join('');
    const pats=DB.patternsV23.map(p=>{let lv=this.s.patterns[p.id]||0; return `<div class="list-card"><div class="row"><div><b>${p.name}</b> Lv.${lv}/20<br><span class="muted">${p.stat} 成長型能力</span></div><button data-act="upPattern" data-arg="${p.id}" ${itemCountIn(this.s.inv,'v23_pattern_stone')>=Math.ceil((lv+1)/2)&&lv<20?'':'disabled'}>升級</button></div></div>`}).join('');
    const holy=DB.holySwordV23.map(h=>{let lv=this.s.holySword[h.id]||0; return `<div class="list-card"><div class="row"><div><b>${h.name}</b> Lv.${lv}/15<br><span class="muted">${Object.entries(h.bonusPer).map(([k,v])=>`${k}+${v}/級`).join('、')}</span></div><button data-act="upHoly" data-arg="${h.id}" ${itemCountIn(this.s.inv,'v23_holy_essence')>=1&&lv<15?'':'disabled'}>升級</button></div></div>`}).join('');
    const runes=Object.values(this.s.inv||{}).filter(x=>this.def(x.id)?.type==='rune').map(x=>this.def(x.id)).filter((v,i,a)=>a.findIndex(z=>z.id===v.id)===i).map(d=>{let lv=this.s.runePlus[d.id]||0; return `<div class="list-card"><div class="row"><div><b class="${rankCss(d.rank)}">${d.name}</b> +${lv}<br><span class="muted">符石強化：傷害與減傷</span></div><button data-act="upRune" data-arg="${d.id}" ${itemCountIn(this.s.inv,'v23_rune_stone')>=1&&lv<10?'':'disabled'}>強化</button></div></div>`}).join('')||'<p class="muted">背包沒有符石</p>';
    return this.hero('魔眼 / 紋樣 / 聖劍 / 符石強化','四個長期養成系統已接入總能力。')+this.statCards([['魔眼石',itemCountIn(this.s.inv,'v23_eye_stone'),'gold'],['紋樣石',itemCountIn(this.s.inv,'v23_pattern_stone'),'blue'],['聖劍精髓',itemCountIn(this.s.inv,'v23_holy_essence'),'purple'],['符石強化石',itemCountIn(this.s.inv,'v23_rune_stone'),'green']])+`<h4 class="title">魔眼</h4><div class="page-list">${eyes}</div><h4 class="title">紋樣</h4><div class="page-list">${pats}</div><h4 class="title">聖劍</h4><div class="page-list">${holy}</div><h4 class="title">符石強化</h4><div class="page-list">${runes}</div>`;
  };
  Game.viewMonsterBookV23=function(){
    const mons=[...new Set(DB.maps.flatMap(m=>m.mons||[]))]; const rows=mons.map(n=>{let k=this.s.codexMon[n]||0, done=k>=100; return `<div class="list-card ${done?'done':''}"><div class="row"><div><b>${$e(n)}</b><br><span class="muted">擊殺 ${k}/100｜完成獎勵：祝福粉末、圖鑑戰力</span></div><button data-act="claimMonBook" data-arg="${$e(n)}" ${done&&!this.s.claimed?.['mon_'+n]?'':'disabled'}>領取</button></div></div>`}).join('');
    return this.hero('怪物圖鑑','自動記錄擊殺數，達成後可領獎。')+this.statCards([['怪物種類',mons.length,'gold'],['已完成',mons.filter(n=>(this.s.codexMon[n]||0)>=100).length,'green'],['總擊殺',Object.values(this.s.codexMon).reduce((a,b)=>a+b,0),'red']])+`<div class="page-list">${rows}</div>`;
  };
  Game.viewMapBookV23=function(){
    const rows=DB.maps.map(m=>{let k=this.s.codexMap[m.id]||0, done=k>=50; return `<div class="list-card ${done?'done':''}"><div class="row"><div><b>${$e(m.name)}</b><br><span class="muted">探索 ${k}/50｜怪物：${(m.mons||[]).join('、')}</span></div><button data-act="claimMapBook" data-arg="${m.id}" ${done&&!this.s.claimed?.['map_'+m.id]?'':'disabled'}>領取</button></div></div>`}).join('');
    return this.hero('地圖圖鑑','切換/狩獵地圖會累積探索值。')+this.statCards([['地圖',DB.maps.length,'gold'],['已完成',DB.maps.filter(m=>(this.s.codexMap[m.id]||0)>=50).length,'green'],['目前地圖',this.map().name,'blue']])+`<div class="page-list">${rows}</div>`;
  };
  Game.viewBossBookV23=function(){
    const names=[...new Set((DB.bosses||[]).map(b=>b.name).concat(Object.keys(this.s.codexBoss||{})))]; const rows=names.map(n=>{let k=this.s.codexBoss[n]||0, done=k>=3; return `<div class="list-card boss-card ${done?'done':''}"><div class="row"><div><b class="red">${$e(n)}</b><br><span class="muted">討伐 ${k}/3｜完成獎勵：TJ憑證、Boss材料</span></div><button data-act="claimBossBook" data-arg="${$e(n)}" ${done&&!this.s.claimed?.['boss_'+n]?'':'disabled'}>領取</button></div></div>`}).join('');
    return this.hero('BOSS圖鑑','世界王、野外王、血盟Boss討伐紀錄。')+this.statCards([['Boss種類',names.length,'red'],['已完成',names.filter(n=>(this.s.codexBoss[n]||0)>=3).length,'green'],['討伐紀錄',Object.values(this.s.codexBoss).reduce((a,b)=>a+b,0),'gold']])+`<div class="page-list">${rows}</div>`;
  };
  Game.viewGuildRaidV23=function(){
    const gb=DB.guildBossV23.map(b=>{let can=this.s.daily.guildBoss>0 && this.s.lv>=b.lv && Object.entries(b.cost).every(([id,q])=>itemCountIn(this.s.inv,id)>=q); return `<div class="list-card boss-card"><div class="row"><div><b class="red">${b.name}</b><br><span class="muted">需求 Lv.${b.lv}｜消耗：${Object.entries(b.cost).map(([id,q])=>DB.item[id].name+'×'+q).join('、')}</span></div><button data-act="guildBoss" data-arg="${b.id}" ${can?'':'disabled'}>召喚討伐</button></div></div>`}).join('');
    const gd=DB.guildDungeonsV23.map(d=>{let can=this.s.daily.guildDungeon>0 && this.s.lv>=d.lv && Object.entries(d.cost).every(([id,q])=>itemCountIn(this.s.inv,id)>=q); return `<div class="list-card"><div class="row"><div><b>${d.name}</b><br><span class="muted">需求 Lv.${d.lv}｜消耗：${Object.entries(d.cost).map(([id,q])=>DB.item[id].name+'×'+q).join('、')}</span></div><button data-act="guildDungeon" data-arg="${d.id}" ${can?'':'disabled'}>進入</button></div></div>`}).join('');
    return this.hero('血盟副本 / 血盟Boss',`今日血盟副本 ${this.s.daily.guildDungeon} 次｜血盟Boss ${this.s.daily.guildBoss} 次。`)+this.statCards([['血盟等級','Lv.'+this.s.guild.lv,'gold'],['副本次數',this.s.daily.guildDungeon,'green'],['Boss次數',this.s.daily.guildBoss,'red'],['召喚石',itemCountIn(this.s.inv,'v23_boss_token'),'purple']])+`<h4 class="title">血盟副本</h4><div class="page-list">${gd}</div><h4 class="title">血盟Boss</h4><div class="page-list">${gb}</div>`;
  };
  Game.viewElixirV23=function(){
    const stats=[['str','力量'],['dex','敏捷'],['con','體質'],['int','智力'],['wis','精神']];
    const rows=stats.map(([id,n])=>`<div class="list-card"><div class="row"><div><b>${n}</b> +${this.s.elixir[id]||0}<br><span class="muted">使用萬能藥永久提升 ${n}</span></div><button data-act="useElixir" data-arg="${id}" ${itemCountIn(this.s.inv,'v23_elixir')>0?'':'disabled'}>使用萬能藥</button></div></div>`).join('');
    const canCraft=itemCountIn(this.s.inv,'v23_elixir_piece')>=20;
    return this.hero('萬能藥系統','收集萬能藥碎片合成萬能藥，永久提升基本能力。')+this.statCards([['萬能藥',itemCountIn(this.s.inv,'v23_elixir'),'gold'],['碎片',itemCountIn(this.s.inv,'v23_elixir_piece')+'/20','green'],['已使用',Object.values(this.s.elixir).reduce((a,b)=>a+b,0),'blue']])+`<div class="card"><button data-act="craftElixir" ${canCraft?'':'disabled'}>20碎片合成萬能藥</button></div><div class="page-list">${rows}</div>`;
  };
  Game.viewSigninV23=function(){
    const now=new Date(), day=now.getDate(), signed=!!this.s.signin.days[day];
    const cells=Array.from({length:28},(_,i)=>i+1).map(d=>`<div class="signin-cell ${this.s.signin.days[d]?'done':d===day?'today':''}"><b>${d}</b><span>${this.s.signin.days[d]?'已簽到':d===day?'今日':'未領'}</span></div>`).join('');
    return this.hero('每日簽到','每日可領一次，依天數提供補給、材料、TJ憑證。',`<button data-act="signin" ${!signed?'':'disabled'}>今日簽到</button>`)+this.statCards([['本月',this.s.signin.month,'gold'],['已簽到',Object.keys(this.s.signin.days).length,'green'],['今日',signed?'已完成':'可領取',signed?'blue':'red']])+`<div class="signin-grid">${cells}</div>`;
  };
  Game.eventProgress=function(ev){ const a=this.s.ach||{}; if(ev.need==='kills')return this.s.daily.kills||0; if(ev.need==='boss')return a.boss||0; if(ev.need==='draw')return a.draw||0; return 0; };
  Game.viewEventsV23=function(){
    const rows=DB.eventsV23.map(ev=>{let p=this.eventProgress(ev), done=this.s.events[ev.id], ready=p>=ev.goal&&!done; return `<div class="list-card ${done?'done':''}"><div class="row"><div><b class="gold">${ev.name}</b> ${ready?'<span class="red-badge">可領取</span>':''}<br><span class="muted">${ev.desc}｜進度 ${p}/${ev.goal}｜獎勵：${Object.entries(ev.reward).map(([id,q])=>DB.item[id].name+'×'+q).join('、')}</span></div><button data-act="claimEvent" data-arg="${ev.id}" ${ready?'':'disabled'}>領取</button></div></div>`}).join('');
    return this.hero('活動系統','活動任務與獎勵，跟狩獵、Boss、抽卡紀錄連動。')+this.statCards([['活動',DB.eventsV23.length,'gold'],['可領取',DB.eventsV23.filter(ev=>this.eventProgress(ev)>=ev.goal&&!this.s.events[ev.id]).length,'red'],['活動硬幣',itemCountIn(this.s.inv,'v23_event_coin'),'green']])+`<div class="page-list">${rows}</div>`;
  };
  Game.viewTJV23=function(){
    return this.hero('TJ完整系統','模擬復原、卡片、強化三種 TJ 機制，每日/活動可取得憑證。')+this.statCards([['TJ憑證',itemCountIn(this.s.inv,'v23_tj_coin'),'gold'],['復原券',this.s.tj.restore,'green'],['卡片券',this.s.tj.card,'purple'],['強化券',this.s.tj.enchant,'blue']])+`<div class="two-col"><div class="card"><b>TJ復原</b><p class="muted">復原近期損失，單機版給予高階材料補償。</p><button data-act="tjRestore" ${this.s.daily.tjRestore>0?'':'disabled'}>使用</button></div><div class="card"><b>TJ卡片</b><p class="muted">依角色等級抽取稀有以上卡片。</p><button data-act="tjCard" ${this.s.daily.tjCard>0?'':'disabled'}>使用</button></div><div class="card"><b>TJ強化</b><p class="muted">給予祝福卷軸與強化支援材料。</p><button data-act="tjEnchant" ${this.s.daily.tjEnchant>0?'':'disabled'}>使用</button></div></div><h4 class="title">紀錄</h4><div class="page-list">${(this.s.tj.history||[]).slice(0,20).map(x=>`<div class="list-card">${new Date(x.t).toLocaleString()}｜${$e(x.msg)}</div>`).join('')||'<p class="muted">尚無紀錄</p>'}</div>`;
  };
  // 商店與交易所覆寫
  Game.viewShop=function(){
    const filter=this.pageState.shopFilter||'all'; const cats=[['all','全部'],['daily','每日'],['supply','補給'],['scroll','卷軸'],['material','材料'],['card','變身/娃娃'],['special','特殊'],['buff','龍之補給'],['awake','覺醒'],['growth','成長'],['book','技能書'],['guild','血盟'],['tj','TJ']];
    const curVal=(cur)=> cur==='diamond'?this.s.diamond:cur==='adena'?this.s.adena:itemCountIn(this.s.inv,cur);
    const curName=(cur)=> cur==='diamond'?'鑽石':cur==='adena'?'金幣':(DB.item[cur]?.name||cur);
    const list=DB.shopV23.filter(g=>filter==='all'||g.cat===filter);
    const cards=list.map(g=>{let bought=(this.s.shopBought||{})[g.id]||0,left=g.limit?Math.max(0,g.limit-bought):'不限', enough=curVal(g.currency)>=g.price; return `<div class="shop-v22-card"><div class="row"><div><b class="${g.currency==='diamond'?'cyan':'gold'}">${$e(g.virtual?g.desc:(DB.item[g.id]?.name||g.desc))}</b><br><span class="muted">${$e(g.desc)}｜限購 ${left}</span></div><span class="pill">${$n(g.price)} ${curName(g.currency)}</span></div><div class="row" style="margin-top:10px"><span class="muted">數量：${g.qty||1}</span><button data-act="buyShopV23" data-arg="${$e(g.id)}" ${(!enough||(g.limit&&bought>=g.limit))?'disabled':''}>購買</button></div></div>`}).join('');
    return this.hero('商城 V23','商店更新：龍之補給、覺醒、成長、技能書、血盟、TJ 分類已加入。')+this.statCards([['鑽石',$n(this.s.diamond),'cyan'],['金幣',$n(this.s.adena),'gold'],['商品',DB.shopV23.length,'green'],['祝福粉末',itemCountIn(this.s.inv,'m18_powder'),'purple'],['TJ憑證',itemCountIn(this.s.inv,'v23_tj_coin'),'red']])+`<div class="tabs page-tabs">${cats.map(([id,n])=>`<button class="tab ${filter===id?'on':''}" data-act="shopFilter" data-arg="${id}">${n}</button>`).join('')}</div><div class="shop-v22-grid">${cards}</div>`;
  };
  const oldMarket=Game.viewMarket;
  Game.viewMarket=function(){
    const filter=this.pageState.marketFilter||'all'; const cats=[['all','全部'],['weapon','武器'],['armor','防具'],['material','材料'],['scroll','卷軸'],['book','技能書'],['buff','消耗/Buff']];
    const items=Object.values(DB.item).filter(d=>filter==='all'||d.type===filter||(filter==='armor'&&['helmet','tshirt','armor','cloak','gloves','boots'].includes(d.type))||(filter==='buff'&&['buff','potion','box','elixir'].includes(d.type))).sort((a,b)=>(b.price||0)-(a.price||0)).slice(0,120);
    const rows=items.map(d=>{let base=d.price||100, trend=Math.sin((Date.now()/86400000)+(d.id.length))*0.18, price=Math.max(1,Math.floor(base*(1+trend))); return `<div class="mrow"><span class="${rankCss(d.rank)}">${$e(d.name)}</span><span>${d.type}</span><span>${$n(price)} 金幣</span><span><button data-act="marketBuy" data-arg="${d.id}">買入</button> <button data-act="marketSell" data-arg="${d.id}">賣出</button></span></div>`}).join('');
    return this.hero('交易所實價系統','依品項基準價與每日波動產生模擬實價，可買入/賣出。')+this.statCards([['品項',items.length,'gold'],['金幣',$n(this.s.adena),'gold'],['持有道具',Object.keys(this.s.inv||{}).length,'green']])+`<div class="tabs page-tabs">${cats.map(([id,n])=>`<button class="tab ${filter===id?'on':''}" data-act="marketFilter" data-arg="${id}">${n}</button>`).join('')}</div><div class="market-table"><div class="mrow head"><span>道具</span><span>類型</span><span>即時行情</span><span>操作</span></div>${rows}</div>`;
  };
  // Actions
  const oldAction=Game.action;
  Game.action=function(a,arg,b){
    const s=this.s;
    const consume=(id,q)=>{if(itemCountIn(s.inv,id)<q)return false; let left=q; Object.keys(s.inv).forEach(k=>{if(left>0&&s.inv[k].id===id){let n=Math.min(left,s.inv[k].qty); this.rem(k,n); left-=n;}}); return true;};
    const reward=(obj)=>Object.entries(obj||{}).forEach(([id,q])=>{ if(id==='adena')s.adena+=this.rand(q[0],q[1]); else this.addItem(id,Array.isArray(q)?this.rand(q[0],q[1]):q); });
    if(a==='cardBookReg'){let book=DB.cardBooksV23.find(x=>x.id===arg); if(book&&this.cardBookReady(book)){s.cardBook[arg]=true; this.log('完成卡片收藏冊：'+book.name,'green'); this.render();} return;}
    if(a==='awakeCard'){let [kind,id]=arg.split('|'), lv=s.awake[kind][id]||0, need=kind==='transform'?'v23_trans_awake':'v23_doll_awake', powder=50*(lv+1); if(lv<5&&consume(need,1)&&consume('m18_powder',powder)){s.awake[kind][id]=lv+1; this.log('覺醒成功：'+DB.cards[id].name+' Lv.'+(lv+1),'green'); this.render();} return;}
    if(a==='awakeRelic'){let lv=s.awake.relic[arg]||0, powder=120*(lv+1); if(lv<5&&consume('v23_relic_awake',1)&&consume('m18_powder',powder)){s.awake.relic[arg]=lv+1; this.log('聖物覺醒成功：'+(DB.item[arg]?.name||arg),'green'); this.render();} return;}
    if(a==='upEye'){let lv=s.magicEyes[arg]||0; if(lv<10&&consume('v23_eye_stone',lv+1)){s.magicEyes[arg]=lv+1; this.render();} return;}
    if(a==='upPattern'){let lv=s.patterns[arg]||0, q=Math.ceil((lv+1)/2); if(lv<20&&consume('v23_pattern_stone',q)){s.patterns[arg]=lv+1; this.render();} return;}
    if(a==='upHoly'){let lv=s.holySword[arg]||0; if(lv<15&&consume('v23_holy_essence',1)){s.holySword[arg]=lv+1; this.render();} return;}
    if(a==='upRune'){let lv=s.runePlus[arg]||0; if(lv<10&&consume('v23_rune_stone',1)){s.runePlus[arg]=lv+1; this.render();} return;}
    if(a==='claimMonBook'){if((s.codexMon[arg]||0)>=100&&!s.claimed['mon_'+arg]){s.claimed['mon_'+arg]=1; this.addItem('m18_powder',50); this.addItem('v23_event_coin',10); this.render();} return;}
    if(a==='claimMapBook'){if((s.codexMap[arg]||0)>=50&&!s.claimed['map_'+arg]){s.claimed['map_'+arg]=1; this.addItem('v23_pattern_stone',3); this.render();} return;}
    if(a==='claimBossBook'){if((s.codexBoss[arg]||0)>=3&&!s.claimed['boss_'+arg]){s.claimed['boss_'+arg]=1; this.addItem('v23_tj_coin',1); this.addItem('v23_boss_token',1); this.render();} return;}
    if(a==='guildBoss'){let gb=DB.guildBossV23.find(x=>x.id===arg); if(gb&&s.daily.guildBoss>0&&Object.entries(gb.cost).every(([id,q])=>itemCountIn(s.inv,id)>=q)){Object.entries(gb.cost).forEach(([id,q])=>consume(id,q)); s.daily.guildBoss--; reward(gb.reward); s.codexBoss[gb.name]=(s.codexBoss[gb.name]||0)+1; this.log('血盟Boss討伐：'+gb.name,'green'); this.render();} return;}
    if(a==='guildDungeon'){let gd=DB.guildDungeonsV23.find(x=>x.id===arg); if(gd&&s.daily.guildDungeon>0&&Object.entries(gd.cost).every(([id,q])=>itemCountIn(s.inv,id)>=q)){Object.entries(gd.cost).forEach(([id,q])=>consume(id,q)); s.daily.guildDungeon--; reward(gd.reward); this.log('完成血盟副本：'+gd.name,'green'); this.render();} return;}
    if(a==='craftElixir'){if(consume('v23_elixir_piece',20)){this.addItem('v23_elixir',1); this.render();} return;}
    if(a==='useElixir'){if(consume('v23_elixir',1)){s.elixir[arg]=(s.elixir[arg]||0)+1; this.log('使用萬能藥：'+arg+' +1','green'); this.render();} return;}
    if(a==='signin'){let d=new Date().getDate(); if(!s.signin.days[d]){s.signin.days[d]=1; s.daily.signin=0; this.addItem('v23_event_coin',10); this.addItem('m18_powder',20); if(d%7===0)this.addItem('v23_tj_coin',1); this.log('每日簽到完成','green'); this.render();} return;}
    if(a==='claimEvent'){let ev=DB.eventsV23.find(x=>x.id===arg); if(ev&&this.eventProgress(ev)>=ev.goal&&!s.events[arg]){s.events[arg]=1; reward(ev.reward); this.log('活動獎勵領取：'+ev.name,'green'); this.render();} return;}
    if(a==='tjRestore'){if(s.daily.tjRestore>0){s.daily.tjRestore--; this.addItem('v23_awake_stone',2); this.addItem('m18_powder',300); s.tj.history.unshift({t:Date.now(),msg:'TJ復原：覺醒石與祝福粉末'}); this.render();} return;}
    if(a==='tjCard'){if(s.daily.tjCard>0){s.daily.tjCard--; this.draw('transform',1); this.draw('doll',1); this.addItem('v23_trans_awake',1); s.tj.history.unshift({t:Date.now(),msg:'TJ卡片：抽卡與變身覺醒石'}); this.render();} return;}
    if(a==='tjEnchant'){if(s.daily.tjEnchant>0){s.daily.tjEnchant--; this.addItem('scroll_bless_weapon',2); this.addItem('scroll_bless_armor',3); this.addItem('v23_rune_stone',2); s.tj.history.unshift({t:Date.now(),msg:'TJ強化：祝福卷軸與符石強化石'}); this.render();} return;}
    if(a==='buyShopV23'){
      let g=DB.shopV23.find(x=>x.id===arg); if(!g)return; s.shopBought=s.shopBought||{}; let bought=s.shopBought[g.id]||0; if(g.limit&&bought>=g.limit){alert('限購已達上限');return;}
      if(g.currency==='diamond'){if(s.diamond<g.price){alert('鑽石不足');return;} s.diamond-=g.price;} else if(g.currency==='adena'){if(s.adena<g.price){alert('金幣不足');return;} s.adena-=g.price;} else {if(!consume(g.currency,g.price)){alert('材料不足');return;}}
      s.shopBought[g.id]=bought+1; if(g.virtual){ if(g.act==='drawT')this.draw('transform',1); if(g.act==='drawT11')this.draw('transform',11); if(g.act==='drawD')this.draw('doll',1); if(g.act==='drawD11')this.draw('doll',11);} else this.addItem(g.id,g.qty||1); this.render(); return;
    }
    if(a==='marketBuy'){let d=DB.item[arg], price=Math.max(1,Math.floor((d?.price||100)*1.12)); if(s.adena>=price){s.adena-=price; this.addItem(arg,1); this.log('交易所買入：'+d.name,'green'); this.render();} return;}
    if(a==='marketSell'){let d=DB.item[arg], k=Object.keys(s.inv).find(k=>s.inv[k].id===arg); if(k){this.rem(k,1); s.adena+=Math.floor((d?.price||100)*0.85); this.log('交易所賣出：'+d.name,'green'); this.render();} return;}
    return oldAction.call(this,a,arg,b);
  };
  // 完整度檢查補強
  const oldAudit=Game.viewAudit;
  Game.viewAudit=function(){
    let html=oldAudit.call(this);
    const systems=['卡片分解','卡片收藏冊','變身覺醒','娃娃覺醒','聖物覺醒','符石強化','魔眼','紋樣','聖劍','技能書掉落','怪物圖鑑','地圖圖鑑','BOSS圖鑑','裝備套裝','血盟Boss','血盟副本','萬能藥','龍之珍珠','龍之鑽石','交易所實價','每日簽到','活動','TJ完整系統','收藏紅點'];
    return html+`<div class="card"><b class="gold">V23 新增完整度</b><br><span class="muted">版本：V23｜已接入系統 ${systems.length}/${systems.length}</span><div class="pill-row">${systems.map(s=>`<span class="pill green">${s}</span>`).join('')}</div></div>`;
  };
  const css=document.createElement('style'); css.textContent=`
    .red-dot{display:inline-block;width:8px;height:8px;border-radius:99px;background:#ef4444;margin-left:5px;box-shadow:0 0 8px #ef4444}.red-badge{display:inline-block;background:#7f1d1d;color:#fecaca;border:1px solid #ef4444;border-radius:99px;padding:2px 7px;margin-left:6px;font-size:12px}.signin-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(90px,1fr));gap:8px}.signin-cell{border:1px solid #26364e;background:#081120;border-radius:12px;padding:10px;text-align:center}.signin-cell.done{border-color:#22c55e;background:#082018}.signin-cell.today{border-color:#facc15;background:#18160a}.signin-cell span{display:block;color:#94a3b8;font-size:12px;margin-top:4px}.pill.green{border-color:#22c55e;color:#86efac}.pill.red{border-color:#ef4444;color:#fca5a5}.pill-row{display:flex;flex-wrap:wrap;gap:6px;margin-top:8px}`; document.head.appendChild(css);
})();


/* V24：葉子實裝 + 裝備職業標註 */
(function(){
  const E = v => String(v??'').replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
  const N = v => Math.floor(v||0).toLocaleString();
  const allClassIds = ()=>Object.keys(DB.classes||{});
  const allClassNames = ()=>allClassIds().map(id=>DB.classes[id].name);
  const equipTypesV24 = ['weapon','helmet','tshirt','armor','cloak','gloves','boots','amulet','belt','earring','ring','rune','seal','relic'];
  const armorTypesV24 = ['helmet','tshirt','armor','cloak','gloves','boots'];
  const accTypesV24 = ['amulet','belt','earring','ring','rune','seal','relic'];
  const slotType = sl => sl==='ring1'||sl==='ring2'?'ring':sl==='earring1'||sl==='earring2'?'earring':sl;

  // 標題版本號
  document.querySelectorAll('.title').forEach(x=>{ if((x.textContent||'').includes('天堂M Core Rebuild')) x.textContent='天堂M Core Rebuild V25'; });
  document.title='天堂M Core Rebuild V25';

  Game.leafProfile=function(){
    const leaf = Math.floor(this.s?.leaf||0);
    const pearl = (this.s?.buffs?.pearl||0) > Date.now();
    if(leaf<=0) return {label:'無葉子',exp:1,adena:1,drop:1,mat:1,consume:0,pearl};
    if(leaf<=50) return {label:'葉子 1~50',exp:1.5,adena:1.3,drop:1.2,mat:1.2,consume:.045,pearl};
    if(leaf<=100) return {label:'葉子 51~100',exp:2.0,adena:1.5,drop:1.4,mat:1.4,consume:.055,pearl};
    return {label:'葉子 101~200',exp:3.0,adena:2.0,drop:1.8,mat:1.8,consume:.07,pearl};
  };

  const oldEnsureV24=Game.ensure;
  Game.ensure=function(){
    oldEnsureV24.call(this);
    this.s.version='core_rebuild_v24';
    this.s.buffs=this.s.buffs||{};
    if(!Number.isFinite(this.s.leaf)) this.s.leaf=200;
    this.s.leaf=Math.max(0,Math.min(200,this.s.leaf));
    this.s.leafStats=this.s.leafStats||{bonusExp:0,bonusAdena:0,extraDrops:0};
  };

  // 葉子恢復/消耗與倍率真正接入戰鬥核心
  Game.fight=function(){
    if(!this.s.mon||this.s.mon.hp<=0)this.spawn();
    this.castAuto();
    const prof=this.leafProfile();
    if(this.s.mon.hp<=0){this.s.mon.__leaf=prof;this.kill(this.s.mon,prof.exp);return;}
    const st=this.total(), m=this.s.mon;
    if(prof.consume>0 && !prof.pearl) this.s.leaf=Math.max(0,(this.s.leaf||0)-prof.consume);
    let dmg=Math.max(1,Math.floor((st.dmg+this.s.lv*2+st.str*1.5+st.dex*.6)*(1+st.spd/100)));
    if(prof.pearl) dmg=Math.floor(dmg*1.15);
    m.hp-=dmg;
    m.__leaf=prof;
    this.blog(`造成 ${dmg} 傷害給 ${m.name}${prof.pearl?' <span class="cyan">龍珠加速</span>':''}`);
    if(m.hp<=0){this.kill(m,prof.exp);return;}
    let take=Math.max(1,Math.floor(m.lv*1.2+(m.boss?40:8)-(10-st.ac)*1.4-(st.dr||0)));
    this.s.hp-=take;
    if(this.s.hp<=0){this.s.hp=this.maxHp()*.55;this.s.exp=Math.max(0,this.s.exp-this.need()*.02);this.s.mon=null;this.blog('<span class="red">瀕死回城，損失少量經驗</span>')}
  };

  const oldKillV24=Game.kill;
  Game.kill=function(m,bonus){
    const prof=m.__leaf||this.leafProfile();
    oldKillV24.call(this,m,prof.exp||bonus||1);
    const extraAdena=Math.floor(this.rand(m.lv*10,m.lv*(m.boss?100:25))*((prof.adena||1)-1));
    if(extraAdena>0){this.s.adena+=extraAdena;this.s.leafStats.bonusAdena=(this.s.leafStats.bonusAdena||0)+extraAdena;}
    if((prof.drop||1)>1){
      const chance=Math.min(.65,.08*((prof.drop||1)-1)+(m.boss?.12:0));
      if(Math.random()<chance){
        const drops=this.map().drops||[]; const id=drops[this.rand(0,drops.length-1)];
        if(id&&this.def(id)){this.addItem(id,1);this.s.leafStats.extraDrops=(this.s.leafStats.extraDrops||0)+1;this.log(`葉子加成額外掉落：${this.def(id).name}`,'green');}
      }
    }
    if((prof.mat||1)>1 && Math.random()<.06*(prof.mat||1)){
      const mats=['m18_powder','v23_skill_page','v23_event_coin','v23_pattern_stone','v23_rune_stone'].filter(id=>DB.item[id]);
      const id=mats[this.rand(0,mats.length-1)]; if(id){this.addItem(id,this.rand(1,m.boss?5:2));this.log(`葉子加成材料掉落：${this.def(id).name}`,'green');}
    }
    this.s.leafStats.bonusExp=(this.s.leafStats.bonusExp||0)+Math.floor((m.lv*m.lv)*((prof.exp||1)-1));
  };

  const oldRenderStatusV24=Game.renderStatus;
  Game.renderStatus=function(){
    oldRenderStatusV24.call(this);
    const prof=this.leafProfile();
    const el=this.$('leafTxt');
    if(el) el.textContent=`${Math.floor(this.s.leaf||0)}/200｜EXP x${prof.exp} 金幣 x${prof.adena} 掉寶 x${prof.drop}${prof.pearl?'｜龍珠中':''}`;
  };

  // 龍之珍珠：30分鐘葉子不消耗 + 攻速；龍之鑽石：補葉並給戰鬥 Buff
  const oldUseV24=Game.use;
  Game.use=function(k){
    const it=this.inv(k), d=this.def(it?.id); if(!it||!d) return;
    const now=Date.now();
    if(d.id==='v23_dragon_pearl'){this.s.buffs.pearl=now+30*60*1000;this.rem(k,1);this.log('使用龍之珍珠：30分鐘葉子不消耗、攻擊效率提升','green');this.render();return;}
    if(d.id==='v23_dragon_diamond'){this.s.leaf=Math.min(200,(this.s.leaf||0)+200);this.s.buffs.dragonDiamond=now+30*60*1000;this.rem(k,1);this.log('使用龍之鑽石：葉子補充 200，30分鐘戰力提升','green');this.render();return;}
    if(d.id==='v23_dragon_s_diamond'){this.s.leaf=200;this.s.buffs.pearl=now+30*60*1000;this.s.buffs.dragonDiamond=now+60*60*1000;this.s.exp+=this.need()*0.25;this.rem(k,1);this.level();this.log('使用高級龍之鑽石：補滿葉子、經驗提升、龍珠效果','green');this.render();return;}
    return oldUseV24.call(this,k);
  };

  // 職業可用判斷與標籤
  Game.itemJobs=function(d){
    if(!d) return [];
    if(Array.isArray(d.jobs)&&d.jobs.length) return d.jobs;
    if(d.type==='weapon') return allClassIds().filter(cid=>(DB.classes[cid].weapons||[]).includes(d.weapon));
    // 部分裝備以天堂M常見邏輯補上限制，未列入則全職業
    const limited={
      dark_robe:['wizard','illusion'], zero_staff:['wizard','illusion'], demon_staff:['wizard','illusion'], ice_queen_staff:['wizard','illusion'], fafu_staff:['wizard','illusion'],
      saiha_bow:['elf'], moon_bow:['elf'], angel_slayer:['elf'], gaia_bow:['elf'], lindvior_bow:['elf'],
      roaring_dual:['darkelf'], shadow_dual:['darkelf'], rondu_claw:['darkelf'], blood_claw:['darkelf'],
      chain_sword:['dragon'], mortal_chain:['dragon'], titan_axe:['warrior'], soul_scythe:['reaper'], thunder_spear:['thunder','lancer'], holy_spear:['lancer','thunder'], zephyr_spear:['lancer','thunder'],
      dragon_slayer:['knight','warrior'], mythic_excalibur:['prince','knight','fencer','lancer']
    };
    return limited[d.id]||allClassIds();
  };
  Game.canUseByClass=function(d,cid=this.s.cls){return this.itemJobs(d).includes(cid);};
  Game.jobLine=function(d){
    const jobs=this.itemJobs(d); const all=jobs.length===allClassIds().length;
    if(all) return `<div class="job-line"><span class="pill job-ok">全職業可用</span></div>`;
    return `<div class="job-line">${allClassIds().map(cid=>`<span class="pill ${jobs.includes(cid)?'job-ok':'job-no'}">${E(DB.classes[cid].name)}</span>`).join('')}</div>`;
  };

  const oldCanEquipV24=Game.canEquipItem;
  Game.canEquipItem=function(d){return d && equipTypesV24.includes(d.type) && this.canUseByClass(d);};
  const oldEquipV24=Game.equip;
  Game.equip=function(k){
    const it=this.inv(k), d=this.def(it?.id);
    if(!d||!equipTypesV24.includes(d.type)) return;
    if(!this.canUseByClass(d)){alert(`目前職業「${this.cls().name}」無法裝備：${d.name}`);return;}
    return oldEquipV24.call(this,k);
  };

  Game.itemCard=function(k){
    const it=this.inv(k), d=this.def(it?.id); if(!d) return '';
    const eq=equipTypesV24.includes(d.type), usable=!eq||this.canUseByClass(d), inUse=Object.values(this.s.equip||{}).includes(k);
    const stat=this.statLine?this.statLine(d,it):'';
    const actions=[];
    if(eq) actions.push(`<button data-act="equip" data-arg="${E(k)}" ${usable&&!inUse?'':'disabled'}>${inUse?'已裝備':usable?'裝備':'職業不可用'}</button>`);
    if(eq && ['weapon'].concat(armorTypesV24,accTypesV24).includes(d.type)) actions.push(`<button data-act="ench" data-arg="${E(k)}">強化</button>`);
    if(['potion','box','buff','elixir'].includes(d.type)) actions.push(`<button data-act="use" data-arg="${E(k)}">使用</button>`);
    if(d.type==='book') actions.push(`<button data-act="learnBook" data-arg="${E(k)}">學習</button>`);
    actions.push(`<button data-act="sell" data-arg="${E(k)}" class="red">賣出</button>`);
    return `<div class="inv-card ${inUse?'on':''} ${eq&&!usable?'job-disabled':''}"><div class="row"><div><b class="r-${d.rank||'N'}">${it.enchant?'+'+it.enchant+' ':''}${E(d.name)}</b><br><span class="muted">${E(d.type)}｜${d.rank||'N'}｜數量 ${it.qty||1}</span></div><span class="pill">戰力 ${this.itemPower?this.itemPower(d,it):0}</span></div><div class="mini muted">${E(stat)}</div>${eq?this.jobLine(d):''}<div class="row" style="justify-content:flex-start;flex-wrap:wrap;margin-top:8px">${actions.join(' ')}</div></div>`;
  };

  Game.viewEquip=function(){
    const slots=this.slots(), st=this.total();
    const rows=Object.entries(slots).map(([sl,label])=>{
      const k=this.s.equip[sl], d=k&&this.def(this.inv(k)?.id), it=k&&this.inv(k);
      if(!d) return `<div class="equip-slot empty"><b>${E(label)}</b><br><span class="muted">未裝備</span></div>`;
      return `<div class="equip-slot"><div class="row"><div><b>${E(label)}</b><br><span class="r-${d.rank}">${it.enchant?'+'+it.enchant+' ':''}${E(d.name)}</span></div><span class="pill">${E(d.rank)}</span></div><div class="mini muted">${E(this.statLine?this.statLine(d,it):'')}</div>${this.jobLine(d)}<div class="row" style="justify-content:flex-start;margin-top:8px"><button data-act="unequip" data-arg="${E(sl)}">卸下</button><button data-act="ench" data-arg="${E(k)}">強化</button></div></div>`;
    }).join('');
    const candidates=Object.keys(this.s.inv||{}).filter(k=>{const d=this.def(this.inv(k).id);return d&&equipTypesV24.includes(d.type)&&!Object.values(this.s.equip||{}).includes(k);}).sort((a,b)=>(this.canUseByClass(this.def(this.inv(b).id))-this.canUseByClass(this.def(this.inv(a).id))) || ((this.itemPower?this.itemPower(this.def(this.inv(b).id),this.inv(b)):0)-(this.itemPower?this.itemPower(this.def(this.inv(a).id),this.inv(a)):0))).slice(0,18).map(k=>this.itemCard(k)).join('');
    const prof=this.leafProfile();
    return this.hero?this.hero('裝備 V24','所有裝備已標註職業可用性，錯誤職業不能裝備。')+this.statCards([['AC',st.ac,'blue'],['傷害',Math.floor(st.dmg+this.s.lv*2),'red'],['命中',st.hit||0,'gold'],['減傷',st.dr||0,'green'],['葉子倍率',`EXP x${prof.exp}`,'cyan'],['目前職業',this.cls().name,'purple']])+`<div class="card"><button data-act="equipBest" class="gold">一鍵最佳裝備</button><span class="muted"> 會自動避開本職業不可用裝備。</span></div><div class="equip-grid">${rows}</div><h4 class="title">背包可替換裝備</h4><div class="inv-grid">${candidates||'<p class="muted">無裝備</p>'}</div>`:`<h3>裝備 V24</h3><div class="equip-grid">${rows}</div>`;
  };

  Game.viewBag=function(){
    const filters=[['all','全部'],['equip','裝備'],['material','材料'],['book','技能書'],['consumable','消耗品'],['buff','龍之道具']];
    this.bagView=this.bagView||'all'; this.bagSort=this.bagSort||'rank';
    let keys=Object.keys(this.s.inv||{}).filter(k=>{const d=this.def(this.inv(k).id); if(!d)return false; if(this.bagView==='all')return true; if(this.bagView==='equip')return equipTypesV24.includes(d.type); if(this.bagView==='consumable')return ['potion','scroll','box'].includes(d.type); if(this.bagView==='buff')return ['buff','elixir'].includes(d.type); return d.type===this.bagView;});
    const rankVal={N:1,R:2,SR:3,SSR:4,L:5,M:6};
    keys.sort((a,b)=>{const da=this.def(this.inv(a).id), db=this.def(this.inv(b).id);return (rankVal[db.rank||'N']-rankVal[da.rank||'N'])||String(da.type).localeCompare(String(db.type),'zh-Hant')||String(da.name).localeCompare(String(db.name),'zh-Hant')});
    const usable=keys.filter(k=>{const d=this.def(this.inv(k).id);return equipTypesV24.includes(d.type)&&this.canUseByClass(d)}).length;
    const blocked=keys.filter(k=>{const d=this.def(this.inv(k).id);return equipTypesV24.includes(d.type)&&!this.canUseByClass(d)}).length;
    return this.hero('背包 V24','裝備道具會顯示可用職業；不可用裝備會灰化且不能裝備。')+this.statCards([['格數',Object.keys(this.s.inv||{}).length,'gold'],['可用裝備',usable,'green'],['職業不可用',blocked,'red'],['祝福粉末',Object.values(this.s.inv||{}).filter(x=>x.id==='m18_powder').reduce((a,x)=>a+x.qty,0),'purple']])+`<div class="tabs page-tabs">${filters.map(([id,n])=>`<button class="tab ${this.bagView===id?'on':''}" data-act="bagView" data-arg="${id}">${n}</button>`).join('')}</div><div class="inv-grid">${keys.map(k=>this.itemCard(k)).join('')||'<p class="muted">此分類沒有道具</p>'}</div>`;
  };

  const oldCraftV24=Game.viewCraft;
  Game.viewCraft=function(){
    const list=Object.values(DB.item||{}).filter(d=>['SSR','L','M'].includes(d.rank)&&equipTypesV24.includes(d.type));
    if(!list.length) return oldCraftV24.call(this);
    return this.hero('製作 V24','製作清單加入職業可用標示，避免做出本職業不能用的裝備。')+`<div class="page-list">${list.map(d=>`<div class="list-card ${this.canUseByClass(d)?'':'job-disabled'}"><div class="row"><div><b class="r-${d.rank}">${E(d.name)}</b><br><span class="muted">需要材料 ${R[d.rank]?.[1]*3||3} / 金幣 ${N((d.price||0)*2)}</span></div><button data-act="craft" data-arg="${d.id}" ${this.canUseByClass(d)?'':'disabled'}>${this.canUseByClass(d)?'製作':'職業不可用'}</button></div>${this.jobLine(d)}</div>`).join('')}</div>`;
  };

  const oldDashV24=Game.viewDash;
  Game.viewDash=function(){
    const prof=this.leafProfile(), pearl=(this.s.buffs?.pearl||0)>Date.now(), dd=(this.s.buffs?.dragonDiamond||0)>Date.now();
    const leafBlock=this.hero?this.hero('V24 葉子實裝狀態',`目前：${prof.label}｜EXP x${prof.exp}｜金幣 x${prof.adena}｜掉寶 x${prof.drop}｜材料 x${prof.mat}`)+this.statCards([['葉子',Math.floor(this.s.leaf||0)+'/200','green'],['龍之珍珠',pearl?'生效中':'未生效',pearl?'cyan':'muted'],['龍之鑽石',dd?'生效中':'未生效',dd?'cyan':'muted'],['額外掉落',this.s.leafStats?.extraDrops||0,'gold']]):'';
    return leafBlock+oldDashV24.call(this);
  };

  const oldAuditV24=Game.viewAudit;
  Game.viewAudit=function(){return oldAuditV24.call(this)+`<div class="card"><b class="gold">V24 修正</b><br><span class="muted">葉子倍率已接入 EXP、金幣、掉寶、材料掉落；龍之珍珠已接入葉子不消耗；裝備/背包/製作已標註職業可用性。</span></div>`;};

  const css=document.createElement('style');css.textContent=`
  .job-line{display:flex;flex-wrap:wrap;gap:4px;margin-top:8px}.job-ok{border-color:#22c55e!important;color:#86efac!important;background:#082018!important}.job-no{border-color:#7f1d1d!important;color:#fca5a5!important;background:#1f0b0b!important}.job-disabled{opacity:.62;filter:saturate(.65)}.leaf-mode{border-color:#22d3ee;color:#a5f3fc}`;document.head.appendChild(css);
})();



/* V25：官方式經驗值表與升級規則 */
(function(){
  const E = v => String(v??'').replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
  const N = v => Math.floor(v||0).toLocaleString();
  // Lv.1~75 採用天堂系經驗表公開資料；Lv.76~99 以 75 後倍增階梯延伸，避免高等級需求過低。
  const REQ = {
    1:125,2:175,3:200,4:250,5:546,6:1105,7:1695,8:2465,9:3439,10:4641,
    11:6095,12:7825,13:9855,14:12209,15:14911,16:17985,17:21455,18:25345,19:29679,20:34481,
    21:39775,22:45585,23:51935,24:58849,25:66351,26:74465,27:83215,28:92625,29:102719,30:113521,
    31:125055,32:137345,33:150415,34:164289,35:178991,36:194545,37:210975,38:228305,39:246559,40:265761,
    41:285935,42:307105,43:329295,44:352529,45:729360,46:1508416,47:3495263,48:9912189,
    49:36065092,50:36065092,51:36065092,52:36065092,53:36065092,54:36065092,55:36065092,56:36065092,
    57:36065092,58:36065092,59:36065092,60:36065092,61:36065092,62:36065092,63:36065092,64:36065092,
    65:72130184,66:72130184,67:72130184,68:72130184,69:72130184,
    70:144260368,71:144260368,72:144260368,73:144260368,74:144260368,75:288520736
  };
  for(let lv=76;lv<=79;lv++) REQ[lv]=288520736;
  for(let lv=80;lv<=84;lv++) REQ[lv]=577041472;
  for(let lv=85;lv<=89;lv++) REQ[lv]=1154082944;
  for(let lv=90;lv<=94;lv++) REQ[lv]=2308165888;
  for(let lv=95;lv<=98;lv++) REQ[lv]=4616331776;
  REQ[99]=Number.MAX_SAFE_INTEGER;
  const CUM = {1:0};
  for(let lv=2;lv<=99;lv++) CUM[lv]=(CUM[lv-1]||0)+(REQ[lv-1]||0);

  document.title='天堂M Core Rebuild V25';
  document.querySelectorAll('.title').forEach(x=>{ if((x.textContent||'').includes('天堂M Core Rebuild')) x.textContent='天堂M Core Rebuild V25'; });

  const oldEnsureV25=Game.ensure;
  Game.ensure=function(){
    oldEnsureV25.call(this);
    this.s.version='core_rebuild_v25_official_exp';
    this.s.lv=Math.max(1,Math.min(99,Math.floor(this.s.lv||1)));
    this.s.exp=Math.max(0,Number.isFinite(this.s.exp)?this.s.exp:0);
    if(this.s.lv>=99) this.s.exp=0;
    this.s.expMode='official_table_v25';
    this.s.expStats=this.s.expStats||{totalEarned:0,deathLost:0,offline:0};
  };

  Game.expNeedTable=function(){ return REQ; };
  Game.totalExpAtLevel=function(lv){ return CUM[Math.max(1,Math.min(99,Math.floor(lv||1)))]||0; };
  Game.need=function(){ return REQ[Math.max(1,Math.min(99,Math.floor(this.s?.lv||1)))] || 288520736; };
  Game.expPct=function(){ return this.s.lv>=99 ? 100 : Math.max(0,Math.min(100,(this.s.exp/this.need())*100)); };
  Game.gainExp=function(amount, reason='經驗取得'){
    amount=Math.floor(Number(amount)||0);
    if(amount<=0 || this.s.lv>=99) return 0;
    this.s.exp += amount;
    this.s.expStats=this.s.expStats||{totalEarned:0,deathLost:0,offline:0};
    this.s.expStats.totalEarned=(this.s.expStats.totalEarned||0)+amount;
    this.level();
    return amount;
  };

  Game.level=function(){
    while(this.s.lv<99 && this.s.exp>=this.need()){
      this.s.exp-=this.need();
      this.s.lv++;
      this.s.hp=this.maxHp();
      this.s.mp=this.maxMp();
      this.log(`升級 Lv.${this.s.lv}｜官方式需求表套用`, 'gold');
    }
    if(this.s.lv>=99){this.s.lv=99;this.s.exp=0;}
  };

  // 重寫戰鬥死亡經驗懲罰：由舊版 2% 改為 5% 當前等級經驗需求。
  Game.fight=function(){
    if(!this.s.mon||this.s.mon.hp<=0)this.spawn();
    this.castAuto();
    const prof=this.leafProfile?this.leafProfile():{exp:1,adena:1,drop:1,mat:1,consume:0};
    if(this.s.mon.hp<=0){this.s.mon.__leaf=prof;this.kill(this.s.mon,prof.exp);return;}
    const st=this.total(), m=this.s.mon;
    if(prof.consume>0 && !prof.pearl) this.s.leaf=Math.max(0,(this.s.leaf||0)-prof.consume);
    let dmg=Math.max(1,Math.floor((st.dmg+this.s.lv*2+st.str*1.5+st.dex*.6)*(1+st.spd/100)));
    if(prof.pearl) dmg=Math.floor(dmg*1.15);
    m.hp-=dmg;
    m.__leaf=prof;
    this.blog(`造成 ${dmg} 傷害給 ${E(m.name)}${prof.pearl?' <span class="cyan">龍珠加速</span>':''}`);
    if(m.hp<=0){this.kill(m,prof.exp);return;}
    let take=Math.max(1,Math.floor(m.lv*1.2+(m.boss?40:8)-(10-st.ac)*1.4-(st.dr||0)));
    this.s.hp-=take;
    if(this.s.hp<=0){
      const lost=Math.min(this.s.exp, Math.floor(this.need()*0.05));
      this.s.hp=this.maxHp()*.55;
      this.s.exp=Math.max(0,this.s.exp-lost);
      this.s.expStats=this.s.expStats||{};
      this.s.expStats.deathLost=(this.s.expStats.deathLost||0)+lost;
      this.s.mon=null;
      this.blog(`<span class="red">瀕死回城，損失 5% 經驗：${N(lost)}</span>`);
    }
  };

  // 修正離線收益走官方需求表，不直接用過低舊公式無限升級。
  Game.offline=function(){
    if(!this.s)return;
    let sec=Math.min(21600,Math.floor((Date.now()-(this.s.last||Date.now()))/1000));
    if(sec>60){
      let gainAdena=sec*(this.s.lv*5);
      let expGain=Math.floor(this.need()*Math.min(0.12, sec/21600*0.08));
      this.s.adena+=gainAdena;
      this.gainExp(expGain,'離線收益');
      this.s.expStats=this.s.expStats||{};
      this.s.expStats.offline=(this.s.expStats.offline||0)+expGain;
      this.log(`離線收益 ${Math.floor(sec/60)} 分鐘，金幣 +${N(gainAdena)}，EXP +${N(expGain)}`);
    }
  };

  const oldUseV25=Game.use;
  Game.use=function(k){
    const it=this.inv(k), d=this.def(it?.id); if(!it||!d) return;
    if(d.id==='v23_dragon_s_diamond'){
      this.s.leaf=200;this.s.buffs=this.s.buffs||{};this.s.buffs.pearl=Date.now()+30*60*1000;this.s.buffs.dragonDiamond=Date.now()+60*60*1000;
      const expGain=Math.floor(this.need()*0.05); // 官方式：高等級需求巨大，固定百分比不宜過高
      this.rem(k,1); this.gainExp(expGain,'高級龍之鑽石');
      this.log(`使用高級龍之鑽石：補滿葉子，EXP +${N(expGain)}，龍珠效果`, 'green'); this.render(); return;
    }
    return oldUseV25.call(this,k);
  };

  const oldRenderStatusV25=Game.renderStatus;
  Game.renderStatus=function(){
    oldRenderStatusV25.call(this);
    const expTxt=this.$('expTxt');
    if(expTxt) expTxt.textContent=this.s.lv>=99?'MAX':`${N(this.s.exp)} / ${N(this.need())}｜${this.expPct().toFixed(4)}%`;
  };

  const oldDashV25=Game.viewDash;
  Game.viewDash=function(){
    const expBlock=this.hero?this.hero('V25',`目前 Lv.${this.s.lv}｜升級需求 ${N(this.need())}｜目前 ${this.expPct().toFixed(4)}%｜死亡懲罰 5%`) + this.statCards([
      ['目前EXP',N(this.s.exp),'gold'],['下級需求',N(this.need()),'cyan'],['累積等級EXP',N(this.totalExpAtLevel(this.s.lv)+this.s.exp),'purple'],['死亡損失',N(this.s.expStats?.deathLost||0),'red']
    ]):'';
    return expBlock+oldDashV25.call(this);
  };

  const oldGrowthV25=Game.viewGrowth;
  Game.viewGrowth=function(){
    const table=[1,10,20,30,40,45,46,47,48,49,50,60,65,70,75,80,85,90,95,99].map(lv=>`<tr><td>Lv.${lv}</td><td>${REQ[lv]===Number.MAX_SAFE_INTEGER?'MAX':N(REQ[lv])}</td><td>${N(CUM[lv]||0)}</td></tr>`).join('');
    const expPanel=`<h3 class="title">經驗值系統 V25</h3><div class="card"><b>官方式需求表</b><p class="muted">1~75 使用公開天堂系等級經驗表；76~99 使用後期倍增階梯延伸。葉子、龍鑽、活動只影響取得 EXP，不改變升級需求。</p><table style="width:100%;border-collapse:collapse"><thead><tr><th align="left">等級</th><th align="right">升下級需求</th><th align="right">累積EXP</th></tr></thead><tbody>${table}</tbody></table></div>`;
    return expPanel+oldGrowthV25.call(this);
  };

  const oldAuditV25=Game.viewAudit;
  Game.viewAudit=function(){
    return oldAuditV25.call(this)+`<div class="card"><b class="gold">V25 修正</b><br><span class="muted">經驗值改為官方式等級需求表；EXP 條顯示精確百分比；死亡損失改為 5%；離線收益與龍鑽改為依當前等級需求百分比計算。</span></div>`;
  };
})();



/* === V27 CHARACTER DAMAGE BALANCE PATCH ===
   目標：整體角色傷害降倍率，避免普攻/技能/卡片/收藏/裝備加成疊乘後過度爆炸。
   調整：
   1. 普攻改為線性加權，裝備與卡片傷害不再完整疊加。
   2. 攻速加成設上限，避免變身速度造成秒怪。
   3. 技能傷害降低，加入冷卻時間，避免每秒連續高威力施放。
   4. 怪物與 Boss HP 依等級放大，讓成長曲線更平滑。
   5. 戰力顯示同步改為新版平衡公式。
*/
(function(){
  const N=n=>Math.floor(Number(n)||0).toLocaleString();
  const clamp=(v,min,max)=>Math.max(min,Math.min(max,v));
  const oldSpawnV27=Game.spawn;
  const oldCastAutoV27=Game.castAuto;

  Game.damageProfile=function(){
    const st=this.total();
    const lv=this.s.lv||1;
    const weaponBase=Math.max(0,Number(st.dmg)||0);
    const mainStat=Math.max(st.str||0, st.dex||0, st.int||0);
    const subStat=(st.str||0)*0.25+(st.dex||0)*0.25+(st.int||0)*0.18;
    const raw=lv*1.05 + weaponBase*0.48 + mainStat*0.72 + subStat + (st.hit||0)*0.06;
    const spd=1+clamp((st.spd||0),0,35)/180; // 最高約 +19.4%，不再直接吃滿 100%+
    const variance=0.92+Math.random()*0.16;
    return {st,lv,raw,spd,variance};
  };

  Game.normalDamage=function(mon){
    const p=this.damageProfile();
    const mapScale=mon?.boss?0.62:1;
    const levelPenalty=mon&&mon.lv>this.s.lv+8 ? Math.max(0.55,1-(mon.lv-this.s.lv-8)*0.025) : 1;
    return Math.max(1,Math.floor(p.raw*p.spd*p.variance*mapScale*levelPenalty));
  };

  Game.skillDamage=function(sk,mon){
    const p=this.damageProfile();
    const slv=this.s.skillLevels?.[sk.id]||1;
    const awake=this.s.skillAwake?.[sk.id]?1.18:1;
    const power=Number(sk.power)||0;
    const statAtk=Math.max(p.st.int||0,p.st.str||0,p.st.dex||0);
    const base=power*0.28 + statAtk*0.85 + p.lv*0.9 + (p.st.dmg||0)*0.22;
    const bossCut=mon?.boss?0.60:1;
    const levelPenalty=mon&&mon.lv>this.s.lv+8 ? Math.max(0.55,1-(mon.lv-this.s.lv-8)*0.025) : 1;
    return Math.max(1,Math.floor(base*(1+slv*0.055)*awake*bossCut*levelPenalty));
  };

  Game.spawn=function(){
    const m=this.map(), name=m.mons[this.rand(0,m.mons.length-1)], lv=this.rand(m.min,m.max);
    let boss=/王|龍|安塔|巴拉|法利|林德|吉爾|君主|首領|Boss/i.test(name);
    if(boss&&!this.s.settings.autoBoss) boss=false;
    const zone=Math.max(1,Math.ceil(lv/20));
    const hp=boss
      ? Math.floor(4200 + lv*260 + zone*1200)
      : Math.floor(220 + lv*42 + zone*120 + Math.pow(lv,1.32)*8);
    this.s.mon={name,lv,boss,hp,max:hp};
    this.blog('遭遇 '+E(name)+(boss?' <span class="orange">BOSS</span>':''));
  };

  Game.castAuto=function(){
    const arr=this.s.settings.autoSkills||[];
    this.s.skillCooldown=this.s.skillCooldown||{};
    const now=Date.now();
    for(let id of arr){
      let sk=DB.skills[id];
      if(!sk||!this.s.learnedSkills[id]||sk.type==='passive'||this.s.mp<(sk.mp||0)) continue;
      const cd=this.s.skillCooldown[id]||0;
      if(now<cd) continue;
      this.s.mp-=sk.mp;
      this.s.skillCooldown[id]=now+(sk.type==='active'?3200:9000);
      if(sk.type==='active'){
        let dmg=this.skillDamage(sk,this.s.mon);
        this.s.mon.hp-=dmg;
        this.blog(`<span class="cyan">自動施放 ${E(sk.name)}</span>，造成 ${N(dmg)} 技能傷害`);
        return;
      }else{
        const lv=this.s.skillLevels[id]||1;
        const heal=Math.floor(35+lv*12+this.s.lv*0.8);
        this.s.hp=Math.min(this.maxHp(),this.s.hp+heal);
        this.blog(`<span class="green">自動施放 ${E(sk.name)}</span>`);
        return;
      }
    }
  };

  Game.fight=function(){
    if(!this.s.mon||this.s.mon.hp<=0)this.spawn();
    this.castAuto();
    if(this.s.mon.hp<=0){this.kill(this.s.mon,this.s.leaf>0?1.25:1);return;}
    const st=this.total(),m=this.s.mon,leafBonus=this.s.leaf>0?1.25:1;
    if(this.s.leaf>0)this.s.leaf=Math.max(0,this.s.leaf-.03);
    const dmg=this.normalDamage(m);
    m.hp-=dmg;
    this.blog(`造成 ${N(dmg)} 傷害給 ${E(m.name)}`);
    if(m.hp<=0){this.kill(m,leafBonus);return;}
    const acReduce=Math.max(0,(10-(st.ac||10))*0.85);
    const drReduce=Math.max(0,(st.dr||0)*0.82);
    const monsterAtk=(m.lv*1.05)+(m.boss?55:10)+Math.pow(Math.max(1,m.lv),1.08)*0.6;
    const take=Math.max(1,Math.floor(monsterAtk-acReduce-drReduce));
    this.s.hp-=take;
    if(this.s.hp<=0){
      const lost=Math.min(this.s.exp||0, Math.floor(this.need()*0.05));
      this.s.hp=this.maxHp()*.55;
      this.s.exp=Math.max(0,(this.s.exp||0)-lost);
      this.s.expStats=this.s.expStats||{};
      this.s.expStats.deathLost=(this.s.expStats.deathLost||0)+lost;
      this.s.mon=null;
      this.blog(`<span class="red">瀕死回城，損失 5% 經驗：${N(lost)}</span>`);
    }
  };

  Game.calcPowerV27=function(){
    const st=this.total();
    return Math.max(0,Math.floor(
      this.s.lv*38 +
      (st.dmg||0)*52 +
      (st.hit||0)*18 +
      Math.max(0,10-(st.ac||10))*18 +
      (st.dr||0)*48 +
      (st.mr||0)*5 +
      (st.hp||0)*0.28 +
      (st.mp||0)*0.18 +
      (st.spd||0)*12
    ));
  };

  const oldRenderStatusV27=Game.renderStatus;
  Game.renderStatus=function(){
    oldRenderStatusV27.call(this);
    const st=this.total();
    const box=this.$('statBox');
    if(box) box.innerHTML=[
      `STR ${st.str}`,`DEX ${st.dex}`,`CON ${st.con}`,`INT ${st.int}`,`WIS ${st.wis}`,
      `AC ${st.ac}`,`平衡傷害 ${this.normalDamage({lv:this.s.lv,boss:false})}`,`命中 ${st.hit||0}`,`減傷 ${st.dr||0}`,`MR ${st.mr||0}`
    ].map(x=>`<div class="stat">${x}</div>`).join('');
  };

  const oldDashV27=Game.viewDash;
  Game.viewDash=function(){
    const panel=this.hero?this.hero('V27 角色傷害平衡',`新版戰力 ${N(this.calcPowerV27())}｜普攻、技能、攻速與Boss傷害已降倍率`) + this.statCards([
      ['新版戰力',N(this.calcPowerV27()),'gold'],
      ['普攻估算',N(this.normalDamage({lv:this.s.lv,boss:false})),'green'],
      ['Boss傷害係數','62%','red'],
      ['技能冷卻','3.2 秒','cyan']
    ]):'';
    return panel+oldDashV27.call(this);
  };

  const oldAuditV27=Game.viewAudit;
  Game.viewAudit=function(){
    return oldAuditV27.call(this)+`<div class="card"><b class="gold">V27 角色傷害平衡</b><br><span class="muted">已降低角色普攻、技能、攻速疊乘與 Boss 輸出倍率；技能加入冷卻；怪物與 Boss HP 依等級提高，避免角色傷害過度變態。</span></div>`;
  };

  document.title='天堂M Core Rebuild V27';
  const mainTitle=document.querySelector('#app .top .title'); if(mainTitle) mainTitle.textContent='天堂M Core Rebuild V27';
})();


/* === V28 OFFICIAL CLASS REPAIR ===
   修復角色職業：移除非天堂M職業資料，改為台版天堂M目前常見職業清單：
   王族、騎士、妖精、法師、黑暗妖精、槍手、龍鬥士、暗黑騎士、神聖劍士、狂戰士、死神、雷神、魔劍士。
*/
(function(){
  const CLASS_ORDER=['prince','knight','elf','wizard','darkelf','gunner','dragon','darkknight','holyknight','berserker','reaper','thunder','magic_swordsman'];
  const officialClasses={
    prince:{id:'prince',name:'王族',stats:{str:13,dex:10,con:12,int:10,wis:11},weapons:['sword','dagger'],desc:'血盟、指揮與近戰輔助'},
    knight:{id:'knight',name:'騎士',stats:{str:16,dex:12,con:15,int:8,wis:9},weapons:['sword','twohand','spear'],desc:'高防禦近戰與暈眩控制'},
    elf:{id:'elf',name:'妖精',stats:{str:11,dex:16,con:12,int:12,wis:13},weapons:['bow','dagger','sword'],desc:'遠程弓箭與精靈魔法'},
    wizard:{id:'wizard',name:'法師',stats:{str:8,dex:10,con:10,int:18,wis:17},weapons:['staff','dagger'],desc:'魔法攻擊、治癒與控場'},
    darkelf:{id:'darkelf',name:'黑暗妖精',stats:{str:14,dex:16,con:12,int:11,wis:10},weapons:['dualblade','claw','dagger'],desc:'爆擊、毒性與高爆發近戰'},
    gunner:{id:'gunner',name:'槍手',stats:{str:10,dex:17,con:12,int:11,wis:12},weapons:['gun','dagger'],desc:'遠程槍械、機動與快速輸出'},
    dragon:{id:'dragon',name:'龍鬥士',stats:{str:16,dex:12,con:15,int:10,wis:10},weapons:['chain_sword'],desc:'鎖鏈劍、龍之力與弱點曝光'},
    darkknight:{id:'darkknight',name:'暗黑騎士',stats:{str:17,dex:12,con:16,int:9,wis:10},weapons:['sword','twohand'],desc:'暗黑之劍、吸血與坦度'},
    holyknight:{id:'holyknight',name:'神聖劍士',stats:{str:16,dex:13,con:15,int:9,wis:12},weapons:['sword','twohand'],desc:'神聖防護、團隊輔助與穩定掛機'},
    berserker:{id:'berserker',name:'狂戰士',stats:{str:17,dex:11,con:17,int:8,wis:9},weapons:['axe','twohand'],desc:'高血量、雙斧與泰坦系技能'},
    reaper:{id:'reaper',name:'死神',stats:{str:15,dex:14,con:14,int:12,wis:11},weapons:['scythe','sword'],desc:'鐮刀、靈魂與收割系攻擊'},
    thunder:{id:'thunder',name:'雷神',stats:{str:14,dex:15,con:13,int:13,wis:12},weapons:['spear','staff'],desc:'雷電、範圍清怪與機動輸出'},
    magic_swordsman:{id:'magic_swordsman',name:'魔劍士',stats:{str:15,dex:13,con:15,int:14,wis:12},weapons:['magic_sword','sword','dagger'],desc:'魔劍、反擊與範圍清怪'}
  };
  DB.classes={}; CLASS_ORDER.forEach(id=>DB.classes[id]=officialClasses[id]);

  function putItem(id,o){ DB.item[id]=Object.assign({id,type:'weapon',rank:'R',price:1000,safe:6},DB.item[id]||{},o); }
  putItem('gunner_rifle',{name:'獵人步槍',type:'weapon',weapon:'gun',dmg:18,rank:'R',price:18000});
  putItem('silver_rifle',{name:'銀光步槍',type:'weapon',weapon:'gun',dmg:28,rank:'SR',price:78000});
  putItem('demon_rifle',{name:'惡魔王步槍',type:'weapon',weapon:'gun',dmg:42,rank:'SSR',price:280000});
  putItem('mythic_rifle',{name:'神話審判步槍',type:'weapon',weapon:'gun',dmg:76,rank:'M',price:2500000});
  putItem('magic_sword_basic',{name:'魔法劍',type:'weapon',weapon:'magic_sword',dmg:21,rank:'R',stat:{int:1},price:22000});
  putItem('dark_magic_sword',{name:'暗黑魔劍',type:'weapon',weapon:'magic_sword',dmg:38,rank:'SSR',stat:{int:2,dmg:4},price:260000});
  putItem('mythic_magic_sword',{name:'神話魔劍',type:'weapon',weapon:'magic_sword',dmg:78,rank:'M',stat:{int:5,dmg:12,dr:4},price:2800000});

  const skillData={
    prince:['精準目標','王族威嚴','激勵士氣','君主之怒','血盟守護','王者命令','突襲指揮','戰場號令','君主反擊','榮耀之劍','王者降臨','君主覺醒'],
    knight:['衝擊之暈','堅固防護','反擊屏障','精準打擊','騎士精神','鋼鐵意志','盾牌衝擊','勇猛意志','重甲熟練','致命突刺','神聖防禦','騎士覺醒'],
    elf:['三重矢','風之疾走','精靈祝福','烈焰箭','水之治癒','大地防護','暴風神射','魂體轉換','精靈命中','月光箭雨','元素守護','妖精覺醒'],
    wizard:['冰錐','高級治癒術','魔力增幅','火球術','聖結界','冥想','流星雨','究極光裂術','魔法命中','寒冰屏障','神聖恢復','法師覺醒'],
    darkelf:['雙重破壞','暗影閃避','燃燒鬥志','毒性衝擊','暗黑盔甲','雙刀熟練','破壞盔甲','暗影之牙','會心強化','黑暗衝擊','暗殺之舞','黑妖覺醒'],
    gunner:['快速射擊','衝刺裝填','精準射擊','魔法彈','煙霧彈','槍械熟練','死亡狙擊','戰術翻滾','彈藥強化','穿甲彈','集中火力','槍手覺醒'],
    dragon:['屠宰者','龍之護鎧','龍族血統','弱點曝光','岩漿噴吐','龍之意志','恐懼無助','覺醒安塔瑞斯','龍之命中','龍炎爆發','龍魂守護','龍鬥覺醒'],
    darkknight:['暗黑之劍','暗黑之魂','深淵護甲','黑暗衝擊','毀滅覺醒','黑暗屏障','吸血斬','深淵凝視','暗黑反擊','血月之力','毀滅劍氣','暗黑騎士覺醒'],
    holyknight:['聖劍術','神聖護盾','團結','審判之劍','聖域','神聖意志','聖光斬','聖潔屏障','神聖命中','聖劍風暴','聖盾加護','神聖劍士覺醒'],
    berserker:['泰坦狂暴','戰士護體','雙斧熟練','粉碎衝擊','咆哮','泰坦之血','戰斧旋風','狂戰士意志','血量強化','巨人一擊','泰坦防禦','狂戰士覺醒'],
    reaper:['死亡鐮刀','靈魂護盾','靈魂熟練','奪魂斬','亡者氣息','收割意志','死神降臨','靈魂爆裂','黑暗命中','終焉收割','死神守護','死神覺醒'],
    thunder:['雷電衝擊','雷神護體','雷槍熟練','閃電鏈','風暴加速','雷電意志','雷霆一擊','天雷落下','雷神命中','暴雷領域','雷神守護','雷神覺醒'],
    magic_swordsman:['魔劍斬擊','魔力護盾','魔劍熟練','超音速','魔法反擊','魔劍意志','裂空斬','魔能爆發','魔劍命中','魔力暴走','魔劍守護','魔劍士覺醒']
  };
  const oldSkills=DB.skills||{}; DB.skills={};
  const types=['active','buff','passive','active','buff','passive','active','buff','passive','active','buff','passive'];
  const typeName={active:'主動攻擊',buff:'輔助/增益',passive:'被動'};
  Object.entries(skillData).forEach(([cls,names])=>{
    names.forEach((name,i)=>{
      const rank=['N','N','R','R','SR','SR','SSR','SSR','L','L','M','M'][i];
      const lv=[1,4,8,12,20,28,38,48,60,70,82,90][i];
      const type=types[i];
      const id='sk_'+cls+'_'+String(i+1).padStart(2,'0');
      const stat=type==='passive'?{dmg:1+Math.floor(i/4),hit:Math.floor(i/5),dr:i>6?1:0}:type==='buff'?{dmg:1+Math.floor(i/5),ac:i>3?-1:0,mr:i>5?2:0}:{dmg:2+Math.floor(i/3)};
      DB.skills[id]=Object.assign({},oldSkills[id]||{},{id,classId:cls,name,rank,lv,type,typeName:typeName[type],mp:type==='passive'?0:8+i*4,power:type==='active'?55+i*18:0,stat,desc:DB.classes[cls].name+'專屬'+typeName[type]+'技能。'});
      const bookId='book_'+id;
      DB.item[bookId]=Object.assign({id:bookId,name:'技能書：'+name,type:'book',rank,price:50000+lv*3500,skill:id},DB.item[bookId]||{});
      DB.item[bookId].skill=id; DB.item[bookId].name='技能書：'+name; DB.item[bookId].type='book';
    });
  });

  const migrate={illusion:'gunner',fencer:'magic_swordsman',lancer:'holyknight',warrior:'berserker'};
  const oldEnsureV28=Game.ensure;
  Game.ensure=function(){
    if(this.s && migrate[this.s.cls]) this.s.cls=migrate[this.s.cls];
    oldEnsureV28.call(this);
    if(this.s && !DB.classes[this.s.cls]) this.s.cls='knight';
    if(this.s){
      this.s.stats=Object.assign({},DB.classes[this.s.cls].stats,this.s.stats||{});
      ['str','dex','con','int','wis'].forEach(k=>{ if(!Number.isFinite(Number(this.s.stats[k]))) this.s.stats[k]=DB.classes[this.s.cls].stats[k]; });
    }
  };

  const oldClassListV28=Game.classList;
  Game.classList=function(){
    const box=this.$('classList');
    if(!box) return oldClassListV28.call(this);
    box.innerHTML=CLASS_ORDER.map(id=>{const c=DB.classes[id];return `<button class="class-card" data-id="${c.id}"><b class="gold">${c.name}</b><br><span class="muted">${c.desc}</span><br><span class="muted">STR ${c.stats.str} / DEX ${c.stats.dex} / INT ${c.stats.int}</span></button>`;}).join('');
    box.querySelectorAll('button').forEach(b=>b.onclick=()=>{this.pick=b.dataset.id;box.querySelectorAll('button').forEach(x=>x.classList.remove('on'));b.classList.add('on');this.$('startBtn').disabled=false;});
  };

  const oldAuditV28=Game.viewAudit;
  Game.viewAudit=function(){
    return oldAuditV28.call(this)+`<div class="card"><b class="gold">V28 職業修復</b><br><span class="muted">已移除/轉換非天堂M角色：幻術士→槍手、劍士→魔劍士、戰士→狂戰士、原槍系命名→神聖劍士。現行角色清單：${CLASS_ORDER.map(id=>DB.classes[id].name).join('、')}。</span></div>`;
  };

  const oldDashV28=Game.viewDash;
  Game.viewDash=function(){
    const p=this.hero?this.hero('V28 天堂M職業修復',`角色職業已修正為 ${CLASS_ORDER.length} 個天堂M職業，並補上槍手、狂戰士、魔劍士技能與武器資料。`):'';
    return p+oldDashV28.call(this);
  };

  document.title='天堂M Core Rebuild V28';
  const mainTitle=document.querySelector('#app .top .title'); if(mainTitle) mainTitle.textContent='天堂M Core Rebuild V28';
  const startTitle=document.querySelector('#start h1'); if(startTitle) startTitle.textContent='天堂M Core Rebuild V28';
})();

document.addEventListener('DOMContentLoaded',()=>Game.init());
</script>
</body></html>
