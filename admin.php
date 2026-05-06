<?php
// Painel Admin VG2 - Repasse de Rotas
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Painel Admin VG2 - Repasse de Rotas</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
* { box-sizing: border-box; }

:root {
  --bg: #050816;
  --card: #111827;
  --card2: #020617;
  --line: #263044;
  --text: #ffffff;
  --muted: #cbd5e1;
  --orange: #ee4d2d;
  --orange2: #ff7a45;
  --blue: #2563eb;
  --green: #16a34a;
  --red: #991b1b;
  --yellow: #ca8a04;
}

body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: radial-gradient(circle at top, #172033 0%, #050816 45%, #02040d 100%);
  color: var(--text);
  min-height: 100vh;
}

body.locked .app { display: none; }

.header {
  padding: 28px 24px;
  background: linear-gradient(135deg, #ee4d2d, #111827);
  border-bottom: 1px solid rgba(255,255,255,.08);
}

.header h1 {
  margin: 0;
  font-size: clamp(30px, 4vw, 48px);
  font-weight: 900;
}

.header p {
  margin: 8px 0 0;
  color: #ffe5dc;
}

.container {
  padding: 24px;
  display: grid;
  gap: 22px;
}

.actions {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
  align-items: center;
}

button {
  border: none;
  border-radius: 14px;
  padding: 13px 16px;
  background: linear-gradient(90deg, var(--orange), var(--orange2));
  color: white;
  font-weight: 900;
  cursor: pointer;
  box-shadow: 0 10px 24px rgba(238,77,45,.18);
}

button:hover { filter: brightness(1.08); }

button:disabled {
  background: #1f2937;
  color: #64748b;
  cursor: not-allowed;
  box-shadow: none;
}

.btn-dark { background: #334155; box-shadow: none; }
.btn-ok { background: var(--green); box-shadow: none; }
.btn-danger { background: var(--red); box-shadow: none; }
.btn-info { background: var(--blue); box-shadow: none; }
.btn-warn { background: var(--yellow); box-shadow: none; }

.card {
  background: linear-gradient(145deg, rgba(17,24,39,.96), rgba(8,13,28,.96));
  border: 1px solid rgba(148,163,184,.24);
  border-radius: 24px;
  padding: 24px;
  box-shadow: 0 18px 45px rgba(0,0,0,.35);
}

.card h2 {
  margin: 0 0 10px;
  color: #ffb199;
  font-size: 26px;
}

.info-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
  gap: 14px;
  margin: 18px 0;
}

.info-box {
  background: var(--card2);
  border: 1px solid var(--line);
  border-radius: 18px;
  padding: 16px;
}

.info-box small { color: #94a3b8; }

.info-box strong {
  display: block;
  margin-top: 8px;
  font-size: 22px;
}

.modal {
  position: fixed;
  inset: 0;
  display: none;
  align-items: center;
  justify-content: center;
  padding: 18px;
  background: rgba(0,0,0,.78);
  backdrop-filter: blur(5px);
  z-index: 50;
}

.modal.show { display: flex; }

.modal-box {
  position: relative;
  width: 100%;
  max-width: 580px;
  max-height: 92vh;
  overflow-y: auto;
  background: linear-gradient(145deg, #111827, #070b17);
  border: 1px solid rgba(148,163,184,.28);
  border-radius: 28px;
  padding: 28px;
  box-shadow: 0 30px 80px rgba(0,0,0,.65);
}

.modal-box.large { max-width: 1120px; }

.modal-close {
  position: absolute;
  top: 14px;
  right: 14px;
  width: 38px;
  height: 38px;
  border-radius: 12px;
  background: #1f2937;
  color: #fff;
  box-shadow: none;
  padding: 0;
  font-size: 20px;
}

.modal-box h2 {
  margin: 0 42px 8px 0;
  color: #ffb199;
  font-size: 30px;
  font-weight: 900;
}

.modal-box p {
  color: var(--muted);
  line-height: 1.5;
}

input, select {
  width: 100%;
  padding: 15px;
  margin: 8px 0;
  border-radius: 15px;
  border: 1px solid #334155;
  background: var(--card2);
  color: white;
  outline: none;
  font-size: 16px;
}

input:focus, select:focus {
  border-color: var(--orange);
  box-shadow: 0 0 0 3px rgba(238,77,45,.18);
}

.modal-actions {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  margin-top: 16px;
}

.modal-actions button { width: auto; }

.badge {
  padding: 7px 11px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 900;
  display: inline-block;
}

.on { background: #064e3b; color: #86efac; }
.off { background: #450a0a; color: #fca5a5; }
.route-ok { background: #064e3b; color: #86efac; }
.route-done { background: #713f12; color: #fde68a; }
.route-cancel { background: #450a0a; color: #fca5a5; }

.notice {
  background: var(--card2);
  border: 1px solid var(--line);
  border-radius: 18px;
  padding: 16px;
  color: var(--muted);
}

.result-box {
  margin-top: 12px;
  padding: 12px;
  border-radius: 14px;
  background: #0b1020;
  border: 1px solid var(--line);
  color: var(--muted);
  white-space: pre-line;
}

.hidden { display: none !important; }

.whatsapp-link {
  color: #86efac;
  font-weight: bold;
  text-decoration: none;
}

.whatsapp-link:hover { text-decoration: underline; }

.notification-btn { position: relative; }

.notification-count {
  background: #dc2626;
  color: white;
  border-radius: 999px;
  padding: 2px 7px;
  font-size: 12px;
  margin-left: 6px;
}

.bell-alert {
  animation: bellShake .75s ease-in-out infinite;
  box-shadow: 0 0 0 3px rgba(238,77,45,.16), 0 0 26px rgba(238,77,45,.45);
}

@keyframes bellShake {
  0%, 100% { transform: rotate(0deg); }
  15% { transform: rotate(8deg); }
  30% { transform: rotate(-8deg); }
  45% { transform: rotate(6deg); }
  60% { transform: rotate(-6deg); }
  75% { transform: rotate(3deg); }
}

.vehicle-options {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
  gap: 10px;
  margin: 14px 0;
}

.vehicle-check {
  display: flex;
  align-items: center;
  gap: 10px;
  background: var(--card2);
  border: 1px solid #334155;
  border-radius: 16px;
  padding: 13px;
  cursor: pointer;
  font-weight: 900;
  color: #e5e7eb;
}

.vehicle-check input {
  width: auto;
  margin: 0;
  accent-color: var(--orange);
}

.vehicle-check:has(input:checked) {
  border-color: var(--orange);
  background: rgba(238,77,45,.15);
  color: white;
}

.routes-panel-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
  margin-bottom: 18px;
}

.routes-panel-actions {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}

.route-search { max-width: 360px; }

.inline-route-list {
  display: grid;
  gap: 16px;
}

.inline-route-item {
  display: grid;
  grid-template-columns: minmax(220px, 1.1fr) minmax(150px, .7fr) minmax(240px, 1fr) auto;
  gap: 18px;
  align-items: center;
  background: var(--card2);
  border: 1px solid var(--line);
  border-radius: 22px;
  padding: 18px;
}

.inline-route-item h3 {
  margin: 0 0 8px;
  font-size: 22px;
}

.inline-route-item p {
  margin: 5px 0;
  color: var(--muted);
}

.inline-actions {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  justify-content: flex-end;
}

.inline-actions button { width: auto; }

.loading-spinner {
  width: 54px;
  height: 54px;
  border-radius: 50%;
  border: 5px solid rgba(255,255,255,.14);
  border-top-color: var(--orange);
  margin: 0 auto 18px;
  animation: spin .8s linear infinite;
}

@keyframes spin { to { transform: rotate(360deg); } }

.feedback-success h2 { color: #86efac; }
.feedback-error h2 { color: #fca5a5; }

.feedback-icon {
  width: 68px;
  height: 68px;
  margin: 0 auto 16px;
  border-radius: 22px;
  display: grid;
  place-items: center;
  font-size: 34px;
  font-weight: 900;
}

.feedback-success .feedback-icon {
  color: #86efac;
  background: rgba(34,197,94,.16);
  border: 1px solid rgba(34,197,94,.45);
}

.feedback-error .feedback-icon {
  color: #fca5a5;
  background: rgba(248,113,113,.14);
  border: 1px solid rgba(248,113,113,.35);
}

.feedback-text {
  white-space: pre-line;
  text-align: center;
}

.waiting-list {
  display: grid;
  gap: 12px;
}

.waiting-item {
  display: grid;
  grid-template-columns: auto 1fr auto;
  gap: 12px;
  align-items: center;
  background: var(--card2);
  border: 1px solid var(--line);
  border-radius: 18px;
  padding: 14px;
}

.waiting-item input {
  width: auto;
  margin: 0;
}

@media (max-width: 900px) {
  .inline-route-item {
    grid-template-columns: 1fr;
  }

  .inline-actions {
    justify-content: stretch;
  }

  .inline-actions button,
  .modal-actions button {
    width: 100%;
  }

  .waiting-item {
    grid-template-columns: 1fr;
  }
}
</style>
</head>

<body class="locked">

<div class="app">
  <div class="header">
    <h1>Painel Admin VG2 - Repasse de Rotas</h1>
    <p>Cadastre motoristas, divulgue rotas, acompanhe repasses e gerencie tudo em tempo real.</p>
  </div>

  <div class="container">
    <div class="actions">
      <button onclick="abrirModal('modalRota')">+ Divulgar rota</button>
      <button onclick="abrirModal('modalMotorista')">+ Novo motorista</button>
      <button onclick="abrirModal('modalConsultaMotorista')">Consultar motorista</button>
      <button class="btn-info" onclick="focarGerenciarRotas()">Gerenciar rotas</button>
      <button class="btn-ok" onclick="abrirGalpao()">Estou no galpão</button>
      <button class="btn-dark notification-btn" onclick="abrirNotificacoes()">🔔 Notificações <span id="notifCount" class="notification-count">0</span></button>
      <button class="btn-dark" onclick="sairAdmin()">Sair</button>
    </div>

    <div class="card routes-panel">
      <div class="routes-panel-header">
        <div>
          <h2>Rotas publicadas</h2>
          <p>Gerencie as rotas divulgadas, veja quem pegou, reabra/reset ou exclua quando necessário.</p>
        </div>

        <div class="routes-panel-actions">
          <input class="route-search" id="filtroRotas" placeholder="Buscar rota, região, motorista ou ID" oninput="renderizarRotasPublicadas()">
          <button class="btn-dark" onclick="carregarRotasAdminInline(true)">Atualizar</button>
        </div>
      </div>

      <div class="info-grid">
        <div class="info-box"><small>Rotas disponíveis</small><strong id="totalDisponiveis">0</strong></div>
        <div class="info-box"><small>Rotas indisponíveis</small><strong id="totalIndisponiveis">0</strong></div>
        <div class="info-box"><small>Motoristas no galpão</small><strong id="totalGalpao">0</strong></div>
        <div class="info-box"><small>Notificações novas</small><strong id="totalNotificacoes">0</strong></div>
      </div>

      <div id="listaRotasInline" class="inline-route-list"></div>
    </div>
  </div>
</div>

<div class="modal show" id="modalLogin">
  <div class="modal-box">
    <h2>Acesso administrativo</h2>
    <p>Informe a senha do painel admin.</p>
    <input id="loginSenha" type="password" placeholder="Senha do admin" autocomplete="off">
    <button onclick="validarLogin()">Entrar</button>
  </div>
</div>

<div class="modal" id="modalRota">
  <div class="modal-box">
    <button class="modal-close" onclick="fecharModal('modalRota')">×</button>
    <h2>Divulgar rota</h2>
    <p>Preencha o nome da rota, região e selecione quais veículos podem pegar.</p>

    <input id="routeName" placeholder="Rota. Ex: B-14+B-15/120">
    <input id="region" placeholder="Região. Ex: Guarulhos">

    <div class="vehicle-options">
      <label class="vehicle-check"><input type="checkbox" class="rotaVeiculo" value="FIORINO" checked> FIORINO</label>
      <label class="vehicle-check"><input type="checkbox" class="rotaVeiculo" value="PASSEIO" checked> PASSEIO</label>
      <label class="vehicle-check"><input type="checkbox" class="rotaVeiculo" value="MOTO"> MOTO</label>
      <label class="vehicle-check"><input type="checkbox" class="rotaVeiculo" value="VAN"> VAN</label>
    </div>

    <div class="notice">
      Status inicial: <strong>DISPONÍVEL</strong><br>
      Somente motoristas com veículo selecionado poderão pegar esta rota.
    </div>

    <div class="modal-actions">
      <button onclick="divulgarRota()">Divulgar rota</button>
      <button class="btn-dark" onclick="fecharModal('modalRota')">Cancelar</button>
    </div>
  </div>
</div>

<div class="modal" id="modalMotorista">
  <div class="modal-box">
    <button class="modal-close" onclick="fecharModal('modalMotorista')">×</button>
    <h2>Cadastrar motorista</h2>
    <p>Adicione um motorista à base.</p>

    <input id="driverId" placeholder="ID do motorista">
    <input id="driverName" placeholder="Nome do motorista">
    <input id="driverTelephone" placeholder="Telefone/WhatsApp. Ex: 11999998888">

    <select id="vehicleType">
      <option value="FIORINO">FIORINO</option>
      <option value="PASSEIO">PASSEIO</option>
      <option value="MOTO">MOTO</option>
      <option value="VAN">VAN</option>
    </select>

    <div class="modal-actions">
      <button onclick="cadastrarMotorista()">Cadastrar</button>
      <button class="btn-dark" onclick="fecharModal('modalMotorista')">Cancelar</button>
    </div>

    <div class="notice" style="margin-top:18px;">
      Importação em massa: envie CSV/XLSX com colunas:
      <strong>driver_id, driver_name, vehicle_type, telephone</strong>
    </div>

    <div class="modal-actions">
      <button class="btn-info" onclick="baixarModeloMotoristas()">Baixar modelo Excel</button>
    </div>

    <input type="file" id="arquivoMotoristas" accept=".csv,.xlsx,.xls">

    <div class="modal-actions">
      <button onclick="importarMotoristasArquivo()">Importar motoristas</button>
    </div>

    <div id="resultadoImportacao" class="result-box hidden"></div>
  </div>
</div>

<div class="modal" id="modalConsultaMotorista">
  <div class="modal-box">
    <button class="modal-close" onclick="fecharModal('modalConsultaMotorista')">×</button>
    <h2>Consultar motorista</h2>
    <p>Digite o ID para consultar, editar telefone/veículo e aplicar tratativas.</p>

    <input id="consultaDriverId" placeholder="ID do motorista">
    <button onclick="consultarMotorista()">Consultar</button>

    <div id="resultadoMotorista" style="display:none; margin-top:18px;">
      <div class="info-grid">
        <div class="info-box"><small>ID</small><strong id="mId"></strong></div>
        <div class="info-box"><small>Nome</small><strong id="mNome"></strong></div>
        <div class="info-box"><small>Status</small><strong id="mStatus"></strong></div>
        <div class="info-box"><small>Punição até</small><strong id="mPunicao"></strong></div>
      </div>

      <label>Telefone</label>
      <input id="editTelefone" placeholder="Telefone/WhatsApp">

      <label>Tipo de veículo</label>
      <select id="editVeiculo">
        <option value="FIORINO">FIORINO</option>
        <option value="PASSEIO">PASSEIO</option>
        <option value="MOTO">MOTO</option>
        <option value="VAN">VAN</option>
      </select>

      <div class="modal-actions">
        <button class="btn-info" onclick="salvarEdicaoMotorista()">Salvar alterações</button>
      </div>

      <hr style="border-color:#263044; margin:18px 0;">

      <label>Tempo de punição</label>
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
        <input id="punishAmount" type="number" min="1" value="15">
        <select id="punishUnit">
          <option value="hours">Horas</option>
          <option value="minutes">Minutos</option>
          <option value="days">Dias</option>
        </select>
      </div>

      <div class="modal-actions">
        <button class="btn-dark" onclick="acaoMotoristaModal('toggle')">Ativar/Desativar</button>
        <button class="btn-warn" onclick="acaoMotoristaModal('punish')">Aplicar punição</button>
        <button class="btn-ok" onclick="acaoMotoristaModal('remove_punish')">Remover punição</button>
      </div>
    </div>

    <div class="modal-actions">
      <button class="btn-dark" onclick="fecharModal('modalConsultaMotorista')">Fechar</button>
    </div>
  </div>
</div>

<div class="modal" id="modalGalpao">
  <div class="modal-box large">
    <button class="modal-close" onclick="fecharModal('modalGalpao')">×</button>
    <h2>Estou no galpão</h2>
    <p>Configure latitude, longitude e raio permitido. Também gerencie os motoristas que registraram presença no galpão.</p>

    <div class="info-grid">
      <div>
        <label>Nome do galpão</label>
        <input id="hubName" placeholder="Galpão">
      </div>
      <div>
        <label>Latitude</label>
        <input id="hubLat" placeholder="-23.000000">
      </div>
      <div>
        <label>Longitude</label>
        <input id="hubLng" placeholder="-46.000000">
      </div>
      <div>
        <label>Raio em metros</label>
        <input id="hubRadius" type="number" placeholder="300">
      </div>
    </div>

    <div class="modal-actions">
      <button onclick="salvarConfigGalpao()">Salvar configuração</button>
      <button class="btn-dark" onclick="carregarAguardandoGalpao()">Atualizar lista</button>
      <button class="btn-danger" onclick="excluirSelecionadosGalpao()">Excluir selecionados</button>
      <button class="btn-danger" onclick="limparGalpaoHoje()">Limpar todos de hoje</button>
    </div>

    <div id="listaGalpao" class="waiting-list" style="margin-top:18px;"></div>
  </div>
</div>

<div class="modal" id="modalNotificacoes">
  <div class="modal-box large">
    <button class="modal-close" onclick="fecharModal('modalNotificacoes')">×</button>
    <h2>Notificações</h2>
    <p>Motoristas que pegaram rota recentemente. Após abrir, esta lista é limpa automaticamente em 1 minuto.</p>
    <div id="listaNotificacoes" class="inline-route-list"></div>

    <div class="modal-actions">
      <button class="btn-dark" onclick="fecharModal('modalNotificacoes')">Fechar</button>
    </div>
  </div>
</div>

<div class="modal" id="modalConfirmacao">
  <div class="modal-box">
    <button class="modal-close" onclick="fecharModal('modalConfirmacao')">×</button>
    <h2 id="confirmTitulo">Confirmar ação</h2>
    <p id="confirmTexto"></p>
    <div class="modal-actions">
      <button id="confirmBtn">Confirmar</button>
      <button class="btn-dark" onclick="fecharModal('modalConfirmacao')">Cancelar</button>
    </div>
  </div>
</div>

<div class="modal" id="modalLoading">
  <div class="modal-box">
    <div class="loading-spinner"></div>
    <h2 id="loadingTitulo">Processando...</h2>
    <p id="loadingTexto">Aguarde enquanto o sistema conclui a operação.</p>
  </div>
</div>

<div class="modal" id="modalFeedback">
  <div class="modal-box" id="feedbackBox">
    <button class="modal-close" onclick="fecharModal('modalFeedback')">×</button>
    <div class="feedback-icon" id="feedbackIcon">✓</div>
    <h2 id="feedbackTitulo"></h2>
    <p id="feedbackTexto" class="feedback-text"></p>
    <div class="modal-actions">
      <button onclick="fecharModal('modalFeedback')">Entendi</button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>

<script>
const SUPABASE_URL = "https://yewfqmgmphswqvpuhfin.supabase.co";
const SUPABASE_ANON_KEY = "SUA_ANON_KEY_AQUI";
const sb = supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);

let motoristaAtual = null;
let notificacoes = [];
let rotasConhecidas = new Map();
let realtimeIniciado = false;
let rotasAtuais = [];
let aguardandoGalpao = [];
let notificacaoLimpezaTimer = null;

function abrirModal(id) { document.getElementById(id).classList.add("show"); }
function fecharModal(id) { document.getElementById(id).classList.remove("show"); }

function mostrarLoading(titulo = "Processando...", texto = "Aguarde enquanto o sistema conclui a operação.") {
  loadingTitulo.innerText = titulo;
  loadingTexto.innerText = texto;
  abrirModal("modalLoading");
}

function esconderLoading() { fecharModal("modalLoading"); }

function mostrarFeedback(tipo, titulo, texto) {
  feedbackBox.classList.remove("feedback-success", "feedback-error");
  if (tipo === "success") {
    feedbackBox.classList.add("feedback-success");
    feedbackIcon.innerText = "✓";
  } else {
    feedbackBox.classList.add("feedback-error");
    feedbackIcon.innerText = "!";
  }
  feedbackTitulo.innerText = titulo;
  feedbackTexto.innerText = texto;
  abrirModal("modalFeedback");
}

async function requisicaoJson(url, options = {}) {
  const res = await fetch(url, options);
  let data = null;
  try { data = await res.json(); } catch (e) { data = null; }
  if (!res.ok || (data && data.error)) throw new Error((data && data.error) ? data.error : "Erro ao processar solicitação.");
  return data;
}

function existeModalAbertoSemLogin() {
  return document.querySelector(".modal.show:not(#modalLogin)") !== null;
}

function headersAdmin() { return { "Content-Type": "application/json" }; }

function limparTelefone(valor) { return String(valor || "").replace(/\D/g, ""); }

function linkWhatsApp(telefone) {
  const numero = limparTelefone(telefone);
  if (!numero) return "-";
  const numeroFinal = numero.startsWith("55") ? numero : "55" + numero;
  return `<a class="whatsapp-link" href="https://wa.me/${numeroFinal}" target="_blank">${telefone}</a>`;
}

async function validarLogin() {
  const senhaDigitada = loginSenha.value.trim();
  if (!senhaDigitada) return;
  mostrarLoading("Validando acesso...", "Aguarde enquanto verificamos sua senha.");
  try {
    const res = await fetch("login.php", { method: "POST", headers: headersAdmin(), body: JSON.stringify({ password: senhaDigitada }) });
    esconderLoading();
    if (res.status !== 200) { loginSenha.value = ""; return; }
    document.body.classList.remove("locked");
    fecharModal("modalLogin");
    await iniciarMonitoramento();
  } catch (err) {
    esconderLoading();
    mostrarFeedback("error", "Erro no login", "Não foi possível validar o acesso agora.");
  }
}

async function tentarLoginSalvo() {
  const res = await fetch("check-session.php?t=" + Date.now(), { cache: "no-store" });
  if (res.status !== 200) return;
  const data = await res.json();
  if (data.logged) {
    document.body.classList.remove("locked");
    fecharModal("modalLogin");
    await iniciarMonitoramento();
  }
}

async function sairAdmin() {
  mostrarLoading("Saindo...", "Aguarde enquanto encerramos a sessão.");
  await fetch("logout.php");
  location.reload();
}

function confirmarAcao(titulo, texto, callback) {
  confirmTitulo.innerText = titulo;
  confirmTexto.innerText = texto;
  confirmBtn.onclick = async () => { await callback(); fecharModal("modalConfirmacao"); };
  abrirModal("modalConfirmacao");
}

async function buscarRotasAdmin() {
  const res = await fetch("admin-routes.php?t=" + Date.now(), { cache: "no-store" });
  if (res.status !== 200) return [];
  return await res.json();
}

function parseVehicles(value) {
  if (Array.isArray(value)) return value;
  return String(value || "").replace("{", "").replace("}", "").replace(/"/g, "").split(",").map(v => v.trim()).filter(Boolean);
}

function formatarVeiculos(value) {
  const veiculos = parseVehicles(value);
  return veiculos.length ? veiculos.join(", ") : "-";
}

function formatarData(value) {
  if (!value) return "-";
  try { return new Date(value).toLocaleString("pt-BR"); } catch { return value; }
}

function badgeRota(status) {
  if (status === "disponivel") return "route-ok";
  if (status === "repassada") return "route-done";
  return "route-cancel";
}

function textoStatus(status) {
  if (status === "disponivel") return "Disponível";
  if (status === "repassada") return "Rota repassada";
  if (status === "cancelada") return "Cancelada";
  return status || "-";
}

function veiculosSelecionadosRota() {
  return Array.from(document.querySelectorAll(".rotaVeiculo:checked")).map(input => input.value);
}

async function divulgarRota() {
  const route_name = routeName.value.trim();
  const route_region = region.value.trim();
  const allowed_vehicles = veiculosSelecionadosRota();

  if (!route_name || !route_region) return mostrarFeedback("error", "Campos obrigatórios", "Preencha a rota e a região para divulgar.");
  if (!allowed_vehicles.length) return mostrarFeedback("error", "Veículo obrigatório", "Selecione pelo menos um tipo de veículo para esta rota.");

  mostrarLoading("Divulgando rota...", "Aguarde enquanto a rota é salva no sistema.");
  try {
    await requisicaoJson("admin-routes.php", {
      method: "POST",
      headers: headersAdmin(),
      body: JSON.stringify({ action: "create", route_name, region: route_region, allowed_vehicles })
    });

    routeName.value = "";
    region.value = "";
    document.querySelectorAll(".rotaVeiculo").forEach(input => {
      input.checked = input.value === "FIORINO" || input.value === "PASSEIO";
    });

    fecharModal("modalRota");
    await carregarRotasAdminInline(true);
    esconderLoading();
    mostrarFeedback("success", "Rota divulgada", "A rota foi cadastrada com sucesso e já está disponível para os veículos selecionados.");
  } catch (err) {
    esconderLoading();
    mostrarFeedback("error", "Erro ao divulgar rota", err.message || "Não foi possível divulgar a rota.");
  }
}

function focarGerenciarRotas() {
  document.querySelector(".routes-panel").scrollIntoView({ behavior: "smooth", block: "start" });
}

function renderizarRotasPublicadas() {
  const termo = String(filtroRotas?.value || "").toLowerCase().trim();
  let rotas = rotasAtuais;

  if (termo) {
    rotas = rotas.filter(r => [r.route_name, r.region, r.claimed_by_driver_name, r.claimed_by_driver_id, r.claimed_vehicle_type, r.claimed_telephone, formatarVeiculos(r.allowed_vehicles), r.status].join(" ").toLowerCase().includes(termo));
  }

  listaRotasInline.innerHTML = rotas.length ? rotas.map(r => `
    <div class="inline-route-item">
      <div>
        <h3>${r.route_name}</h3>
        <p>${r.region || "-"}</p>
        <p><strong>Permitidos:</strong> ${formatarVeiculos(r.allowed_vehicles)}</p>
      </div>
      <div><span class="badge ${badgeRota(r.status)}">${textoStatus(r.status)}</span></div>
      <div>
        <p><strong>Motorista:</strong> ${r.claimed_by_driver_name || "-"}</p>
        <p><strong>ID:</strong> ${r.claimed_by_driver_id || "-"}</p>
        <p><strong>Veículo:</strong> ${r.claimed_vehicle_type || "-"}</p>
        <p><strong>Telefone:</strong> ${linkWhatsApp(r.claimed_telephone)}</p>
        <p><strong>Horário:</strong> ${formatarData(r.claimed_at)}</p>
      </div>
      <div class="inline-actions">
        <button class="btn-ok" onclick="reabrirRota(${r.id})">Abrir disponível</button>
        <button class="btn-danger" onclick="excluirRota(${r.id})">Excluir</button>
      </div>
    </div>
  `).join("") : `<div class="notice">Nenhuma rota encontrada.</div>`;
}

async function carregarRotasAdminInline() {
  try {
    rotasAtuais = await buscarRotasAdmin();
    let disponiveis = 0, indisponiveis = 0;
    rotasAtuais.forEach(r => {
      if (r.status === "disponivel") disponiveis++;
      if (r.status === "repassada") indisponiveis++;
      rotasConhecidas.set(String(r.id), r);
    });
    totalDisponiveis.innerText = disponiveis;
    totalIndisponiveis.innerText = indisponiveis;
    totalNotificacoes.innerText = notificacoes.length;
    renderizarRotasPublicadas();
  } catch (err) {
    listaRotasInline.innerHTML = `<div class="notice">Erro ao carregar rotas publicadas.</div>`;
  }
}

function reabrirRota(id) {
  confirmarAcao("Reabrir rota", "Essa ação vai deixar a rota disponível novamente e liberar o motorista para pegar outra rota.", async () => {
    mostrarLoading("Reabrindo rota...", "Aguarde enquanto a rota é resetada.");
    try {
      await requisicaoJson("admin-routes.php", { method: "POST", headers: headersAdmin(), body: JSON.stringify({ action: "reopen", id }) });
      await carregarRotasAdminInline();
      esconderLoading();
      mostrarFeedback("success", "Rota reaberta", "A rota foi resetada com sucesso e voltou a ficar disponível.");
    } catch (err) {
      esconderLoading();
      mostrarFeedback("error", "Erro ao reabrir rota", err.message || "Não foi possível reabrir a rota.");
    }
  });
}

function excluirRota(id) {
  confirmarAcao("Excluir rota", "Essa ação vai remover a rota do sistema.", async () => {
    mostrarLoading("Excluindo rota...", "Aguarde enquanto a rota é removida do sistema.");
    try {
      await requisicaoJson("admin-routes.php", { method: "POST", headers: headersAdmin(), body: JSON.stringify({ action: "delete", id }) });
      await carregarRotasAdminInline();
      esconderLoading();
      mostrarFeedback("success", "Rota excluída", "A rota foi removida com sucesso.");
    } catch (err) {
      esconderLoading();
      mostrarFeedback("error", "Erro ao excluir rota", err.message || "Não foi possível excluir a rota.");
    }
  });
}

async function cadastrarMotorista() {
  const body = {
    action: "create",
    driver_id: driverId.value.trim(),
    driver_name: driverName.value.trim(),
    vehicle_type: vehicleType.value,
    telephone: driverTelephone.value.trim()
  };

  if (!body.driver_id || !body.driver_name || !body.vehicle_type) return mostrarFeedback("error", "Campos obrigatórios", "Preencha ID, nome e veículo do motorista.");

  mostrarLoading("Cadastrando motorista...", "Aguarde enquanto o motorista é salvo no sistema.");
  try {
    await requisicaoJson("admin-drivers.php", { method: "POST", headers: headersAdmin(), body: JSON.stringify(body) });
    driverId.value = "";
    driverName.value = "";
    driverTelephone.value = "";
    vehicleType.value = "FIORINO";
    fecharModal("modalMotorista");
    esconderLoading();
    mostrarFeedback("success", "Motorista cadastrado", "Motorista cadastrado/atualizado com sucesso.");
  } catch (err) {
    esconderLoading();
    mostrarFeedback("error", "Erro ao cadastrar motorista", err.message || "Não foi possível cadastrar o motorista.");
  }
}

async function consultarMotorista() {
  const id = consultaDriverId.value.trim();
  if (!id) return mostrarFeedback("error", "ID obrigatório", "Informe o ID do motorista para consultar.");

  mostrarLoading("Consultando motorista...", "Aguarde enquanto buscamos as informações.");
  try {
    const res = await fetch("admin-drivers.php?driver_id=" + encodeURIComponent(id) + "&t=" + Date.now(), { cache: "no-store" });
    if (res.status !== 200) throw new Error("Erro ao consultar motorista.");
    const d = await res.json();
    esconderLoading();

    if (!d) {
      resultadoMotorista.style.display = "none";
      mostrarFeedback("error", "Motorista não encontrado", "Nenhum motorista foi encontrado com esse ID.");
      return;
    }

    motoristaAtual = d;
    mId.innerText = d.driver_id;
    mNome.innerText = d.driver_name;
    mStatus.innerHTML = d.active ? "ATIVO" : "DESATIVADO";
    mStatus.className = d.active ? "on badge" : "off badge";
    mPunicao.innerText = d.punished_until ? formatarData(d.punished_until) : "-";
    editTelefone.value = d.telephone || "";
    editVeiculo.value = d.vehicle_type || "FIORINO";
    resultadoMotorista.style.display = "block";
  } catch (err) {
    esconderLoading();
    mostrarFeedback("error", "Erro na consulta", err.message || "Não foi possível consultar o motorista.");
  }
}

async function salvarEdicaoMotorista() {
  if (!motoristaAtual) return;

  mostrarLoading("Salvando motorista...", "Aguarde enquanto atualizamos os dados.");
  try {
    await requisicaoJson("admin-drivers.php", {
      method: "POST",
      headers: headersAdmin(),
      body: JSON.stringify({
        action: "update",
        driver_id: motoristaAtual.driver_id,
        telephone: editTelefone.value.trim(),
        vehicle_type: editVeiculo.value
      })
    });

    esconderLoading();
    mostrarFeedback("success", "Motorista atualizado", "Telefone e tipo de veículo foram atualizados com sucesso.");
    await consultarMotorista();
  } catch (err) {
    esconderLoading();
    mostrarFeedback("error", "Erro ao salvar", err.message || "Não foi possível atualizar o motorista.");
  }
}

function acaoMotoristaModal(action) {
  if (!motoristaAtual) return;

  const texto = {
    toggle: `Deseja ativar/desativar ${motoristaAtual.driver_name}?`,
    punish: `Deseja aplicar punição em ${motoristaAtual.driver_name}?`,
    remove_punish: `Deseja remover a punição de ${motoristaAtual.driver_name}?`
  };

  confirmarAcao("Confirmar tratativa", texto[action], async () => {
    mostrarLoading("Aplicando tratativa...", "Aguarde enquanto atualizamos o cadastro do motorista.");

    try {
      const payload = { action, driver_id: motoristaAtual.driver_id };

      if (action === "punish") {
        payload.amount = Number(punishAmount.value || 15);
        payload.unit = punishUnit.value || "hours";
      }

      await requisicaoJson("admin-drivers.php", { method: "POST", headers: headersAdmin(), body: JSON.stringify(payload) });

      esconderLoading();
      mostrarFeedback("success", "Tratativa aplicada", "A ação foi aplicada com sucesso.");
      await consultarMotorista();
    } catch (err) {
      esconderLoading();
      mostrarFeedback("error", "Erro na tratativa", err.message || "Não foi possível aplicar a ação.");
    }
  });
}

function normalizarTexto(valor) { return String(valor ?? "").trim(); }
function normalizarVeiculo(valor) {
  const v = normalizarTexto(valor).toUpperCase();
  return ["FIORINO", "PASSEIO", "MOTO", "VAN"].includes(v) ? v : v;
}

function baixarModeloMotoristas() {
  const dados = [
    ["driver_id", "driver_name", "vehicle_type", "telephone"],
    ["123456", "MOTORISTA EXEMPLO", "FIORINO", "11999998888"],
    ["789012", "MOTORISTA EXEMPLO 2", "PASSEIO", "11988887777"],
    ["555888", "MOTORISTA EXEMPLO 3", "MOTO", "11977776666"],
    ["999000", "MOTORISTA EXEMPLO 4", "VAN", "11966665555"]
  ];
  const ws = XLSX.utils.aoa_to_sheet(dados);
  const wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, "Motoristas");
  XLSX.writeFile(wb, "modelo_importacao_motoristas.xlsx");
}

async function lerArquivoMotoristas(file) {
  const nome = file.name.toLowerCase();
  if (nome.endsWith(".xlsx") || nome.endsWith(".xls")) {
    const buffer = await file.arrayBuffer();
    const wb = XLSX.read(buffer, { type: "array" });
    const ws = wb.Sheets[wb.SheetNames[0]];
    const json = XLSX.utils.sheet_to_json(ws, { defval: "" });
    return json.map(row => ({ driver_id: normalizarTexto(row.driver_id), driver_name: normalizarTexto(row.driver_name), vehicle_type: normalizarVeiculo(row.vehicle_type), telephone: normalizarTexto(row.telephone) }));
  }
  if (nome.endsWith(".csv")) {
    const texto = await file.text();
    const linhas = texto.split(/\r?\n/).filter(Boolean).map(l => l.split(","));
    const header = linhas[0].map(h => h.trim().toLowerCase());
    const idxId = header.indexOf("driver_id"), idxNome = header.indexOf("driver_name"), idxVeiculo = header.indexOf("vehicle_type"), idxTelefone = header.indexOf("telephone");
    return linhas.slice(1).map(l => ({ driver_id: normalizarTexto(l[idxId]), driver_name: normalizarTexto(l[idxNome]), vehicle_type: normalizarVeiculo(l[idxVeiculo]), telephone: idxTelefone >= 0 ? normalizarTexto(l[idxTelefone]) : "" }));
  }
  throw new Error("Formato não aceito. Use CSV, XLSX ou XLS.");
}

async function importarMotoristasArquivo() {
  const file = arquivoMotoristas.files[0];
  resultadoImportacao.classList.add("hidden");
  resultadoImportacao.innerText = "";

  if (!file) return mostrarFeedback("error", "Arquivo obrigatório", "Selecione um arquivo CSV, XLSX ou XLS para importar.");

  mostrarLoading("Importando motoristas...", "Aguarde enquanto o arquivo é lido e enviado ao sistema.");

  try {
    const drivers = await lerArquivoMotoristas(file);
    const validos = drivers.filter(d => d.driver_id && d.driver_name && ["FIORINO", "PASSEIO", "MOTO", "VAN"].includes(d.vehicle_type));
    const invalidos = drivers.map((d, i) => ({ ...d, linha: i + 2 })).filter(d => !d.driver_id || !d.driver_name || !["FIORINO", "PASSEIO", "MOTO", "VAN"].includes(d.vehicle_type));

    if (!validos.length) {
      esconderLoading();
      const detalhes = invalidos.length ? invalidos.map(d => `Linha ${d.linha}: ID, nome ou veículo inválido`).join("\\n") : "Nenhum motorista válido encontrado.";
      mostrarFeedback("error", "Importação não realizada", detalhes);
      return;
    }

    const data = await requisicaoJson("admin-drivers.php", { method: "POST", headers: headersAdmin(), body: JSON.stringify({ action: "bulk_create", drivers: validos }) });
    arquivoMotoristas.value = "";

    const errosServidor = Array.isArray(data.erros) && data.erros.length ? "\\n\\nOcorrências:\\n" + data.erros.join("\\n") : "";
    const errosArquivo = invalidos.length ? "\\n\\nLinhas inválidas no arquivo:\\n" + invalidos.map(d => `Linha ${d.linha}: ID, nome ou veículo inválido`).join("\\n") : "";
    const resumo = `Importação finalizada.\\nImportados/atualizados: ${data.importados ?? 0}\\nIgnorados pelo sistema: ${data.ignorados ?? 0}${errosServidor}${errosArquivo}`;

    resultadoImportacao.innerText = resumo;
    resultadoImportacao.classList.remove("hidden");
    esconderLoading();

    if ((data.ignorados ?? 0) > 0 || invalidos.length > 0) mostrarFeedback("error", "Importação concluída com alertas", resumo);
    else mostrarFeedback("success", "Importação concluída", resumo);
  } catch (err) {
    esconderLoading();
    resultadoImportacao.innerText = err.message || "Erro ao importar.";
    resultadoImportacao.classList.remove("hidden");
    mostrarFeedback("error", "Erro na importação", err.message || "Não foi possível importar os motoristas.");
  }
}

async function abrirGalpao() {
  abrirModal("modalGalpao");
  await carregarConfigGalpao();
  await carregarAguardandoGalpao();
}

async function carregarConfigGalpao() {
  try {
    const cfg = await requisicaoJson("hub-config.php?t=" + Date.now(), { cache: "no-store" });
    if (!cfg) return;
    hubName.value = cfg.hub_name || "Galpão";
    hubLat.value = cfg.latitude || "";
    hubLng.value = cfg.longitude || "";
    hubRadius.value = cfg.radius_meters || 300;
  } catch (err) {
    mostrarFeedback("error", "Erro ao carregar configuração", err.message || "Não foi possível carregar o galpão.");
  }
}

async function salvarConfigGalpao() {
  if (!hubLat.value || !hubLng.value || !hubRadius.value) return mostrarFeedback("error", "Campos obrigatórios", "Preencha latitude, longitude e raio.");

  mostrarLoading("Salvando galpão...", "Aguarde enquanto a configuração é salva.");

  try {
    await requisicaoJson("hub-config.php", {
      method: "POST",
      headers: headersAdmin(),
      body: JSON.stringify({
        hub_name: hubName.value.trim() || "Galpão",
        latitude: Number(hubLat.value),
        longitude: Number(hubLng.value),
        radius_meters: Number(hubRadius.value)
      })
    });

    esconderLoading();
    mostrarFeedback("success", "Galpão atualizado", "Latitude, longitude e raio foram salvos com sucesso.");
  } catch (err) {
    esconderLoading();
    mostrarFeedback("error", "Erro ao salvar galpão", err.message || "Não foi possível salvar a configuração.");
  }
}

async function carregarAguardandoGalpao() {
  try {
    aguardandoGalpao = await requisicaoJson("admin-waiting.php?t=" + Date.now(), { cache: "no-store" });
    totalGalpao.innerText = aguardandoGalpao.length;

    listaGalpao.innerHTML = aguardandoGalpao.length ? aguardandoGalpao.map(w => `
      <div class="waiting-item">
        <input type="checkbox" class="galpaoCheck" value="${w.id}">
        <div>
          <strong>${w.driver_name}</strong>
          <p>ID: ${w.driver_id} | Veículo: ${w.vehicle_type}</p>
          <p>Telefone: ${linkWhatsApp(w.telephone)}</p>
          <p>Distância: ${Math.round(Number(w.distance_meters || 0))}m | Horário: ${formatarData(w.created_at)}</p>
        </div>
        <button class="btn-danger" onclick="excluirGalpaoUm(${w.id})">Excluir</button>
      </div>
    `).join("") : `<div class="notice">Nenhum motorista aguardando rota no galpão hoje.</div>`;
  } catch (err) {
    listaGalpao.innerHTML = `<div class="notice">Erro ao carregar motoristas no galpão.</div>`;
  }
}

async function excluirGalpaoUm(id) {
  confirmarAcao("Excluir presença", "Deseja remover este registro de presença no galpão?", async () => {
    mostrarLoading("Excluindo presença...", "Aguarde enquanto removemos o registro.");
    try {
      await requisicaoJson("admin-waiting.php", { method: "POST", headers: headersAdmin(), body: JSON.stringify({ action: "delete", id }) });
      await carregarAguardandoGalpao();
      esconderLoading();
      mostrarFeedback("success", "Presença removida", "Registro removido com sucesso.");
    } catch (err) {
      esconderLoading();
      mostrarFeedback("error", "Erro ao remover", err.message || "Não foi possível remover.");
    }
  });
}

async function excluirSelecionadosGalpao() {
  const ids = Array.from(document.querySelectorAll(".galpaoCheck:checked")).map(i => Number(i.value));
  if (!ids.length) return mostrarFeedback("error", "Nenhuma seleção", "Selecione ao menos um registro para excluir.");

  confirmarAcao("Excluir selecionados", `Deseja remover ${ids.length} registro(s) selecionado(s)?`, async () => {
    mostrarLoading("Excluindo selecionados...", "Aguarde enquanto removemos os registros.");
    try {
      await requisicaoJson("admin-waiting.php", { method: "POST", headers: headersAdmin(), body: JSON.stringify({ action: "delete_many", ids }) });
      await carregarAguardandoGalpao();
      esconderLoading();
      mostrarFeedback("success", "Registros removidos", "Registros selecionados removidos com sucesso.");
    } catch (err) {
      esconderLoading();
      mostrarFeedback("error", "Erro ao remover", err.message || "Não foi possível remover.");
    }
  });
}

async function limparGalpaoHoje() {
  confirmarAcao("Limpar todos", "Deseja remover todos os registros de presença do galpão de hoje?", async () => {
    mostrarLoading("Limpando galpão...", "Aguarde enquanto removemos todos os registros de hoje.");
    try {
      await requisicaoJson("admin-waiting.php", { method: "POST", headers: headersAdmin(), body: JSON.stringify({ action: "clear_today" }) });
      await carregarAguardandoGalpao();
      esconderLoading();
      mostrarFeedback("success", "Lista limpa", "Todos os registros de hoje foram removidos.");
    } catch (err) {
      esconderLoading();
      mostrarFeedback("error", "Erro ao limpar", err.message || "Não foi possível limpar os registros.");
    }
  });
}

async function verificarNovosRepasses() {
  if (document.body.classList.contains("locked")) return;
  const rotas = await buscarRotasAdmin();

  rotas.forEach(r => {
    const id = String(r.id);
    const antes = rotasConhecidas.get(id);

    if (antes && antes.status === "disponivel" && r.status === "repassada") {
      notificacoes.unshift({ ...r, notification_created_at: Date.now() });
      notifCount.innerText = String(notificacoes.length);
      totalNotificacoes.innerText = String(notificacoes.length);
      document.querySelector(".notification-btn").classList.add("bell-alert");
    }

    rotasConhecidas.set(id, r);
  });

  rotasAtuais = rotas;
  renderizarRotasPublicadas();

  let disponiveis = 0, indisponiveis = 0;
  rotas.forEach(r => {
    if (r.status === "disponivel") disponiveis++;
    if (r.status === "repassada") indisponiveis++;
  });

  totalDisponiveis.innerText = disponiveis;
  totalIndisponiveis.innerText = indisponiveis;
}

function abrirNotificacoes() {
  notifCount.innerText = "0";
  document.querySelector(".notification-btn").classList.remove("bell-alert");
  abrirModal("modalNotificacoes");

  listaNotificacoes.innerHTML = notificacoes.length ? notificacoes.map(n => `
    <div class="inline-route-item" style="border-left:5px solid #ee4d2d;">
      <div>
        <h3>🔔 ${n.route_name}</h3>
        <p>${n.region || "-"}</p>
      </div>
      <div><span class="badge route-done">Indisponível</span></div>
      <div>
        <p><strong>Motorista:</strong> ${n.claimed_by_driver_name || "-"}</p>
        <p><strong>ID:</strong> ${n.claimed_by_driver_id || "-"}</p>
        <p><strong>Veículo:</strong> ${n.claimed_vehicle_type || "-"}</p>
        <p><strong>Telefone:</strong> ${linkWhatsApp(n.claimed_telephone)}</p>
        <p><strong>Horário:</strong> ${formatarData(n.claimed_at)}</p>
      </div>
      <div></div>
    </div>
  `).join("") : `<div class="notice">Nenhuma notificação nova.</div>`;

  if (notificacaoLimpezaTimer) clearTimeout(notificacaoLimpezaTimer);

  notificacaoLimpezaTimer = setTimeout(() => {
    notificacoes = [];
    notifCount.innerText = "0";
    totalNotificacoes.innerText = "0";
    document.querySelector(".notification-btn").classList.remove("bell-alert");

    if (document.getElementById("modalNotificacoes").classList.contains("show")) {
      listaNotificacoes.innerHTML = `<div class="notice">As notificações abertas foram limpas automaticamente após 1 minuto.</div>`;
    }
  }, 60000);
}

function iniciarRealtimeAdmin() {
  if (realtimeIniciado) return;
  realtimeIniciado = true;

  sb.channel("admin-routes-realtime")
    .on("postgres_changes", { event: "*", schema: "public", table: "routes" }, () => verificarNovosRepasses())
    .on("postgres_changes", { event: "*", schema: "public", table: "driver_waiting_hub" }, () => carregarAguardandoGalpao())
    .subscribe();
}

async function iniciarMonitoramento() {
  await carregarRotasAdminInline();
  await carregarAguardandoGalpao();
  iniciarRealtimeAdmin();
}

loginSenha.addEventListener("keydown", e => { if (e.key === "Enter") validarLogin(); });
consultaDriverId.addEventListener("keydown", e => { if (e.key === "Enter") consultarMotorista(); });

tentarLoginSalvo();
setInterval(verificarNovosRepasses, 10000);
setInterval(carregarAguardandoGalpao, 15000);
</script>
</body>
</html>
