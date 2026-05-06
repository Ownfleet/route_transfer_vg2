<?php
// Painel Admin - Repasse de Rotas
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Painel Admin - Repasse de Rotas</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
* { box-sizing: border-box; }

body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: radial-gradient(circle at top, #172033 0%, #050816 45%, #02040d 100%);
  color: white;
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
  font-size: clamp(28px, 4vw, 42px);
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
}

button {
  border: none;
  border-radius: 14px;
  padding: 13px 16px;
  background: linear-gradient(90deg, #ee4d2d, #ff7a45);
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
.btn-ok { background: #16a34a; box-shadow: none; }
.btn-danger { background: #991b1b; box-shadow: none; }
.btn-info { background: #2563eb; box-shadow: none; }
.btn-warn { background: #ca8a04; box-shadow: none; }

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
  margin-top: 18px;
}

.info-box {
  background: #020617;
  border: 1px solid #263044;
  border-radius: 18px;
  padding: 16px;
}

.info-box small {
  color: #94a3b8;
}

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
  width: 100%;
  max-width: 560px;
  max-height: 92vh;
  overflow-y: auto;
  background: linear-gradient(145deg, #111827, #070b17);
  border: 1px solid rgba(148,163,184,.28);
  border-radius: 28px;
  padding: 28px;
  box-shadow: 0 30px 80px rgba(0,0,0,.65);
}

.modal-box.large {
  max-width: 1040px;
}

.modal-box h2 {
  margin: 0 0 8px;
  color: #ffb199;
  font-size: 30px;
  font-weight: 900;
}

.modal-box p {
  color: #cbd5e1;
  line-height: 1.5;
}

input, select {
  width: 100%;
  padding: 15px;
  margin: 8px 0;
  border-radius: 15px;
  border: 1px solid #334155;
  background: #020617;
  color: white;
  outline: none;
  font-size: 16px;
}

input:focus, select:focus {
  border-color: #ee4d2d;
  box-shadow: 0 0 0 3px rgba(238,77,45,.18);
}

.modal-actions {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  margin-top: 16px;
}

.modal-actions button {
  width: auto;
}

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

.route-list {
  display: grid;
  gap: 14px;
  margin-top: 16px;
}

.route-item {
  background: #020617;
  border: 1px solid #263044;
  border-radius: 20px;
  padding: 18px;
}

.route-top {
  display: flex;
  justify-content: space-between;
  gap: 12px;
  flex-wrap: wrap;
}

.route-top h3 {
  margin: 0;
  font-size: 22px;
}

.small {
  font-size: 13px;
  color: #94a3b8;
}

.notice {
  background: #020617;
  border: 1px solid #263044;
  border-radius: 18px;
  padding: 16px;
  color: #cbd5e1;
}

.result-box {
  margin-top: 12px;
  padding: 12px;
  border-radius: 14px;
  background: #0b1020;
  border: 1px solid #263044;
  color: #cbd5e1;
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

@media (max-width: 620px) {
  .container { padding: 16px; }
  .modal-box { padding: 22px; }
  .modal-actions button { width: 100%; }
}
</style>
</head>

<body class="locked">

<div class="app">
  <div class="header">
    <h1>Painel Admin - Repasse de Rotas</h1>
    <p>Cadastre motoristas, divulgue rotas, acompanhe repasses e gerencie tudo em tempo real.</p>
  </div>

  <div class="container">
    <div class="actions">
      <button onclick="abrirModal('modalRota')">+ Divulgar rota</button>
      <button onclick="abrirModal('modalMotorista')">+ Novo motorista</button>
      <button onclick="abrirModal('modalConsultaMotorista')">Consultar motorista</button>
      <button class="btn-info" onclick="abrirGerenciarRotas()">Gerenciar rotas</button>
      <button class="btn-dark notification-btn" onclick="abrirNotificacoes()">🔔 Notificações <span id="notifCount" class="notification-count">0</span></button>
      <button class="btn-dark" onclick="sairAdmin()">Sair</button>
    </div>

    <div class="card">
      <h2>Resumo</h2>
      <p>O admin cria rota preenchendo apenas <strong>rota</strong> e <strong>região</strong>. Os veículos são fixos: FIORINO, PASSEIO, MOTO e VAN.</p>

      <div class="info-grid">
        <div class="info-box"><small>Rotas disponíveis</small><strong id="totalDisponiveis">0</strong></div>
        <div class="info-box"><small>Rotas indisponíveis</small><strong id="totalIndisponiveis">0</strong></div>
        <div class="info-box"><small>Notificações</small><strong id="totalNotificacoes">0</strong></div>
      </div>
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
    <h2>Divulgar rota</h2>
    <p>Preencha apenas o nome da rota e a região. O sistema libera automaticamente para FIORINO, PASSEIO, MOTO e VAN.</p>

    <input id="routeName" placeholder="Rota. Ex: B-14+B-15/120">
    <input id="region" placeholder="Região. Ex: Guarulhos">

    <div class="notice">
      Veículos liberados: <strong>FIORINO, PASSEIO, MOTO, VAN</strong><br>
      Status inicial: <strong>DISPONÍVEL</strong>
    </div>

    <div class="modal-actions">
      <button onclick="divulgarRota()">Divulgar rota</button>
      <button class="btn-dark" onclick="fecharModal('modalRota')">Cancelar</button>
    </div>
  </div>
</div>

<div class="modal" id="modalMotorista">
  <div class="modal-box">
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
    <h2>Consultar motorista</h2>
    <p>Digite o ID para consultar e aplicar tratativas.</p>

    <input id="consultaDriverId" placeholder="ID do motorista">
    <button onclick="consultarMotorista()">Consultar</button>

    <div id="resultadoMotorista" style="display:none; margin-top:18px;">
      <div class="info-grid">
        <div class="info-box"><small>ID</small><strong id="mId"></strong></div>
        <div class="info-box"><small>Nome</small><strong id="mNome"></strong></div>
        <div class="info-box"><small>Veículo</small><strong id="mVeiculo"></strong></div>
        <div class="info-box"><small>Telefone</small><strong id="mTelefone"></strong></div>
        <div class="info-box"><small>Status</small><strong id="mStatus"></strong></div>
        <div class="info-box"><small>Punição até</small><strong id="mPunicao"></strong></div>
      </div>

      <div class="modal-actions">
        <button class="btn-dark" onclick="acaoMotoristaModal('toggle')">Ativar/Desativar</button>
        <button class="btn-warn" onclick="acaoMotoristaModal('punish')">Punir 15h</button>
        <button class="btn-ok" onclick="acaoMotoristaModal('remove_punish')">Remover punição</button>
      </div>
    </div>

    <div class="modal-actions">
      <button class="btn-dark" onclick="fecharModal('modalConsultaMotorista')">Fechar</button>
    </div>
  </div>
</div>

<div class="modal" id="modalGerenciarRotas">
  <div class="modal-box large">
    <h2>Gerenciar rotas</h2>
    <p>Veja quem pegou, reabra/reset ou exclua rotas divulgadas.</p>
    <div id="listaRotas" class="route-list"></div>

    <div class="modal-actions">
      <button class="btn-dark" onclick="fecharModal('modalGerenciarRotas')">Fechar</button>
    </div>
  </div>
</div>

<div class="modal" id="modalNotificacoes">
  <div class="modal-box large">
    <h2>Notificações</h2>
    <p>Motoristas que pegaram rota recentemente.</p>
    <div id="listaNotificacoes" class="route-list"></div>

    <div class="modal-actions">
      <button class="btn-dark" onclick="fecharModal('modalNotificacoes')">Fechar</button>
    </div>
  </div>
</div>

<div class="modal" id="modalConfirmacao">
  <div class="modal-box">
    <h2 id="confirmTitulo">Confirmar ação</h2>
    <p id="confirmTexto"></p>
    <div class="modal-actions">
      <button id="confirmBtn">Confirmar</button>
      <button class="btn-dark" onclick="fecharModal('modalConfirmacao')">Cancelar</button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>

<script>
const SUPABASE_URL = "https://yewfqmgmphswqvpuhfin.supabase.co";
const SUPABASE_ANON_KEY = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Inlld2ZxbWdtcGhzd3F2cHVoZmluIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzgwNjAzNDcsImV4cCI6MjA5MzYzNjM0N30.DJcUn4nU-yDtCZatK8e8XhDwi2e4qa3oEdyPOdYi4xs";
const sb = supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);

let motoristaAtual = null;
let notificacoes = [];
let rotasConhecidas = new Map();
let realtimeIniciado = false;

function abrirModal(id) {
  document.getElementById(id).classList.add("show");
}

function fecharModal(id) {
  document.getElementById(id).classList.remove("show");
}

function existeModalAbertoSemLogin() {
  return document.querySelector(".modal.show:not(#modalLogin)") !== null;
}

function headersAdmin() {
  return { "Content-Type": "application/json" };
}

function limparTelefone(valor) {
  return String(valor || "").replace(/\D/g, "");
}

function linkWhatsApp(telefone) {
  const numero = limparTelefone(telefone);
  if (!numero) return "-";
  const numeroFinal = numero.startsWith("55") ? numero : "55" + numero;
  return `<a class="whatsapp-link" href="https://wa.me/${numeroFinal}" target="_blank">${telefone}</a>`;
}

async function validarLogin() {
  const senhaDigitada = loginSenha.value.trim();
  if (!senhaDigitada) return;

  const res = await fetch("login.php", {
    method: "POST",
    headers: headersAdmin(),
    body: JSON.stringify({ password: senhaDigitada })
  });

  if (res.status !== 200) {
    loginSenha.value = "";
    return;
  }

  document.body.classList.remove("locked");
  fecharModal("modalLogin");
  await iniciarMonitoramento();
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
  await fetch("logout.php");
  location.reload();
}

function confirmarAcao(titulo, texto, callback) {
  confirmTitulo.innerText = titulo;
  confirmTexto.innerText = texto;
  confirmBtn.onclick = async () => {
    await callback();
    fecharModal("modalConfirmacao");
  };
  abrirModal("modalConfirmacao");
}

async function buscarRotasAdmin() {
  const res = await fetch("admin-routes.php?t=" + Date.now(), { cache: "no-store" });
  if (res.status !== 200) return [];
  return await res.json();
}

function parseVehicles(value) {
  if (Array.isArray(value)) return value;
  return String(value || "")
    .replace("{", "")
    .replace("}", "")
    .replace(/"/g, "")
    .split(",")
    .map(v => v.trim())
    .filter(Boolean);
}

function formatarVeiculos(value) {
  const veiculos = parseVehicles(value);
  return veiculos.length ? veiculos.join(", ") : "-";
}

function formatarData(value) {
  if (!value) return "-";
  try {
    return new Date(value).toLocaleString("pt-BR");
  } catch {
    return value;
  }
}

function badgeRota(status) {
  if (status === "disponivel") return "route-ok";
  if (status === "repassada") return "route-done";
  return "route-cancel";
}

function textoStatus(status) {
  if (status === "disponivel") return "DISPONÍVEL";
  if (status === "repassada") return "INDISPONÍVEL";
  if (status === "cancelada") return "CANCELADA";
  return status || "-";
}

async function divulgarRota() {
  const route_name = routeName.value.trim();
  const route_region = region.value.trim();

  if (!route_name || !route_region) return;

  const res = await fetch("admin-routes.php", {
    method: "POST",
    headers: headersAdmin(),
    body: JSON.stringify({
      action: "create",
      route_name,
      region: route_region,
      allowed_vehicles: ["FIORINO", "PASSEIO", "MOTO", "VAN"]
    })
  });

  if (res.status !== 200) return;

  routeName.value = "";
  region.value = "";
  fecharModal("modalRota");
  await atualizarBaseRotas(true);
}

async function carregarRotasAdmin() {
  const rotas = await buscarRotasAdmin();

  listaRotas.innerHTML = rotas.length ? rotas.map(r => `
    <div class="route-item">
      <div class="route-top">
        <h3>${r.route_name}</h3>
        <span class="badge ${badgeRota(r.status)}">${textoStatus(r.status)}</span>
      </div>

      <p><strong>Região:</strong> ${r.region}</p>
      <p><strong>Veículos:</strong> ${formatarVeiculos(r.allowed_vehicles)}</p>
      <p><strong>Motorista:</strong> ${r.claimed_by_driver_name || "-"}</p>
      <p><strong>ID:</strong> ${r.claimed_by_driver_id || "-"}</p>
      <p><strong>Veículo do motorista:</strong> ${r.claimed_vehicle_type || "-"}</p>
      <p><strong>Telefone:</strong> ${linkWhatsApp(r.claimed_telephone)}</p>
      <p><strong>Horário:</strong> ${formatarData(r.claimed_at)}</p>

      <div class="modal-actions">
        <button class="btn-ok" onclick="reabrirRota(${r.id})">Reabrir/resetar</button>
        <button class="btn-danger" onclick="excluirRota(${r.id})">Excluir</button>
      </div>
    </div>
  `).join("") : `<div class="notice">Nenhuma rota divulgada ainda.</div>`;
}

async function abrirGerenciarRotas() {
  abrirModal("modalGerenciarRotas");
  await carregarRotasAdmin();
}

function reabrirRota(id) {
  confirmarAcao(
    "Reabrir rota",
    "Essa ação vai deixar a rota disponível novamente e liberar o motorista para pegar outra rota.",
    async () => {
      await fetch("admin-routes.php", {
        method: "POST",
        headers: headersAdmin(),
        body: JSON.stringify({ action: "reopen", id })
      });

      await carregarRotasAdmin();
      await atualizarBaseRotas(true);
    }
  );
}

function excluirRota(id) {
  confirmarAcao(
    "Excluir rota",
    "Essa ação vai remover a rota do sistema.",
    async () => {
      await fetch("admin-routes.php", {
        method: "POST",
        headers: headersAdmin(),
        body: JSON.stringify({ action: "delete", id })
      });

      await carregarRotasAdmin();
      await atualizarBaseRotas(true);
    }
  );
}

async function cadastrarMotorista() {
  const body = {
    action: "create",
    driver_id: driverId.value.trim(),
    driver_name: driverName.value.trim(),
    vehicle_type: vehicleType.value,
    telephone: driverTelephone.value.trim()
  };

  if (!body.driver_id || !body.driver_name || !body.vehicle_type) return;

  const res = await fetch("admin-drivers.php", {
    method: "POST",
    headers: headersAdmin(),
    body: JSON.stringify(body)
  });

  if (res.status !== 200) return;

  driverId.value = "";
  driverName.value = "";
  driverTelephone.value = "";
  vehicleType.value = "FIORINO";
  fecharModal("modalMotorista");
}

async function consultarMotorista() {
  const id = consultaDriverId.value.trim();
  if (!id) return;

  const res = await fetch("admin-drivers.php?driver_id=" + encodeURIComponent(id) + "&t=" + Date.now(), { cache: "no-store" });
  if (res.status !== 200) return;

  const d = await res.json();

  if (!d) {
    resultadoMotorista.style.display = "none";
    return;
  }

  motoristaAtual = d;

  mId.innerText = d.driver_id;
  mNome.innerText = d.driver_name;
  mVeiculo.innerText = d.vehicle_type;
  mTelefone.innerHTML = linkWhatsApp(d.telephone);
  mStatus.innerHTML = d.active ? "ATIVO" : "DESATIVADO";
  mStatus.className = d.active ? "on badge" : "off badge";
  mPunicao.innerText = d.punished_until ? formatarData(d.punished_until) : "-";

  resultadoMotorista.style.display = "block";
}

function acaoMotoristaModal(action) {
  if (!motoristaAtual) return;

  const texto = {
    toggle: `Deseja ativar/desativar ${motoristaAtual.driver_name}?`,
    punish: `Deseja punir ${motoristaAtual.driver_name} por 15 horas?`,
    remove_punish: `Deseja remover a punição de ${motoristaAtual.driver_name}?`
  };

  confirmarAcao("Confirmar tratativa", texto[action], async () => {
    await fetch("admin-drivers.php", {
      method: "POST",
      headers: headersAdmin(),
      body: JSON.stringify({
        action,
        driver_id: motoristaAtual.driver_id
      })
    });

    await consultarMotorista();
  });
}

function normalizarTexto(valor) {
  return String(valor ?? "").trim();
}

function normalizarVeiculo(valor) {
  const v = normalizarTexto(valor).toUpperCase();
  if (["FIORINO", "PASSEIO", "MOTO", "VAN"].includes(v)) return v;
  return v;
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

    return json.map(row => ({
      driver_id: normalizarTexto(row.driver_id),
      driver_name: normalizarTexto(row.driver_name),
      vehicle_type: normalizarVeiculo(row.vehicle_type),
      telephone: normalizarTexto(row.telephone)
    }));
  }

  if (nome.endsWith(".csv")) {
    const texto = await file.text();
    const linhas = texto.split(/\r?\n/).filter(Boolean).map(l => l.split(","));
    const header = linhas[0].map(h => h.trim().toLowerCase());

    const idxId = header.indexOf("driver_id");
    const idxNome = header.indexOf("driver_name");
    const idxVeiculo = header.indexOf("vehicle_type");
    const idxTelefone = header.indexOf("telephone");

    return linhas.slice(1).map(l => ({
      driver_id: normalizarTexto(l[idxId]),
      driver_name: normalizarTexto(l[idxNome]),
      vehicle_type: normalizarVeiculo(l[idxVeiculo]),
      telephone: idxTelefone >= 0 ? normalizarTexto(l[idxTelefone]) : ""
    }));
  }

  throw new Error("Formato não aceito. Use CSV, XLSX ou XLS.");
}

async function importarMotoristasArquivo() {
  const file = arquivoMotoristas.files[0];

  resultadoImportacao.classList.add("hidden");
  resultadoImportacao.innerText = "";

  if (!file) return;

  try {
    const drivers = await lerArquivoMotoristas(file);

    const validos = drivers.filter(d =>
      d.driver_id &&
      d.driver_name &&
      ["FIORINO", "PASSEIO", "MOTO", "VAN"].includes(d.vehicle_type)
    );

    if (!validos.length) {
      resultadoImportacao.innerText = "Nenhum motorista válido encontrado.";
      resultadoImportacao.classList.remove("hidden");
      return;
    }

    const res = await fetch("admin-drivers.php", {
      method: "POST",
      headers: headersAdmin(),
      body: JSON.stringify({
        action: "bulk_create",
        drivers: validos
      })
    });

    if (res.status !== 200) return;

    const data = await res.json();

    resultadoImportacao.innerText =
      `Importação finalizada.\nImportados/atualizados: ${data.importados ?? 0}\nIgnorados: ${data.ignorados ?? 0}`;

    resultadoImportacao.classList.remove("hidden");
    arquivoMotoristas.value = "";

  } catch (err) {
    resultadoImportacao.innerText = err.message || "Erro ao importar.";
    resultadoImportacao.classList.remove("hidden");
  }
}

async function atualizarBaseRotas(forcar = false) {
  if (document.body.classList.contains("locked")) return;
  if (!forcar && existeModalAbertoSemLogin()) return;

  const rotas = await buscarRotasAdmin();

  let disponiveis = 0;
  let indisponiveis = 0;

  rotas.forEach(r => {
    if (r.status === "disponivel") disponiveis++;
    if (r.status === "repassada") indisponiveis++;

    rotasConhecidas.set(String(r.id), r);
  });

  totalDisponiveis.innerText = disponiveis;
  totalIndisponiveis.innerText = indisponiveis;
  totalNotificacoes.innerText = notificacoes.length;
}

async function verificarNovosRepasses() {
  if (document.body.classList.contains("locked")) return;

  const rotas = await buscarRotasAdmin();

  rotas.forEach(r => {
    const id = String(r.id);
    const antes = rotasConhecidas.get(id);

    if (antes && antes.status === "disponivel" && r.status === "repassada") {
      notificacoes.unshift(r);
      notifCount.innerText = String(notificacoes.length);
      totalNotificacoes.innerText = String(notificacoes.length);
    }

    rotasConhecidas.set(id, r);
  });

  await atualizarBaseRotas(true);

  if (document.getElementById("modalGerenciarRotas").classList.contains("show")) {
    await carregarRotasAdmin();
  }
}

function abrirNotificacoes() {
  notifCount.innerText = "0";
  abrirModal("modalNotificacoes");

  listaNotificacoes.innerHTML = notificacoes.length
    ? notificacoes.map(n => `
      <div class="route-item">
        <div class="route-top">
          <h3>🔔 ${n.route_name}</h3>
          <span class="badge route-done">INDISPONÍVEL</span>
        </div>
        <p><strong>Motorista:</strong> ${n.claimed_by_driver_name || "-"}</p>
        <p><strong>ID:</strong> ${n.claimed_by_driver_id || "-"}</p>
        <p><strong>Veículo:</strong> ${n.claimed_vehicle_type || "-"}</p>
        <p><strong>Telefone:</strong> ${linkWhatsApp(n.claimed_telephone)}</p>
        <p><strong>Região:</strong> ${n.region || "-"}</p>
        <p><strong>Horário:</strong> ${formatarData(n.claimed_at)}</p>
      </div>
    `).join("")
    : `<div class="notice">Nenhuma notificação nova.</div>`;
}

function iniciarRealtimeAdmin() {
  if (realtimeIniciado) return;
  realtimeIniciado = true;

  sb.channel("admin-routes-realtime")
    .on("postgres_changes", { event: "*", schema: "public", table: "routes" }, () => {
      verificarNovosRepasses();
    })
    .subscribe();
}

async function iniciarMonitoramento() {
  await atualizarBaseRotas(true);
  iniciarRealtimeAdmin();
}

loginSenha.addEventListener("keydown", e => {
  if (e.key === "Enter") validarLogin();
});

consultaDriverId.addEventListener("keydown", e => {
  if (e.key === "Enter") consultarMotorista();
});

tentarLoginSalvo();
setInterval(verificarNovosRepasses, 10000);
</script>

</body>
</html>
