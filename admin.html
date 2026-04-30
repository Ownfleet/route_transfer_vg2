<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel Admin - Repasse de Rotas</title>

<style>
* { box-sizing: border-box; }

body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: #050816;
  color: white;
}

body.locked .app { display: none; }

.header {
  padding: 24px;
  background: linear-gradient(135deg, #ee4d2d, #111827);
}

.header h1 { margin: 0; font-size: 30px; }
.header p { margin: 6px 0 0; color: #ffe5dc; }

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
  padding: 12px 16px;
  background: #ee4d2d;
  color: white;
  font-weight: bold;
  cursor: pointer;
}

button:hover { background: #ff6a3d; }

button:disabled {
  background: #1f2937;
  color: #6b7280;
  cursor: not-allowed;
}

.btn-dark { background: #374151; }
.btn-warn { background: #ca8a04; }
.btn-ok { background: #16a34a; }
.btn-danger { background: #991b1b; }
.btn-info { background: #2563eb; }

.card {
  background: #111827;
  border: 1px solid #263044;
  border-radius: 22px;
  padding: 22px;
  box-shadow: 0 15px 35px rgba(0,0,0,.35);
}

.card h2 {
  margin-top: 0;
  color: #ffb199;
}

.info-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
  gap: 12px;
}

.info-box {
  background: #020617;
  border: 1px solid #263044;
  border-radius: 16px;
  padding: 14px;
}

.info-box small {
  color: #94a3b8;
}

.info-box strong {
  display: block;
  margin-top: 6px;
  font-size: 18px;
}

input, select {
  width: 100%;
  padding: 14px;
  margin: 8px 0;
  border-radius: 14px;
  border: 1px solid #374151;
  background: #020617;
  color: white;
  outline: none;
}

input:focus, select:focus { border-color: #ee4d2d; }

.modal {
  display: none;
  position: fixed;
  inset: 0;
  z-index: 999;
  background: rgba(0,0,0,.78);
  align-items: center;
  justify-content: center;
  padding: 18px;
}

.modal.show { display: flex; }

.modal-box {
  width: 100%;
  max-width: 560px;
  max-height: 92vh;
  overflow-y: auto;
  background: linear-gradient(145deg, #111827, #080d1c);
  border: 1px solid #374151;
  border-radius: 24px;
  padding: 24px;
  box-shadow: 0 25px 60px rgba(0,0,0,.55);
}

.modal-box.large {
  max-width: 980px;
}

.modal-box h2 {
  margin: 0 0 8px;
  color: #ffb199;
}

.modal-box p {
  color: #cbd5e1;
  line-height: 1.5;
}

.modal-actions {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  margin-top: 14px;
}

.checks {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
  margin: 12px 0;
}

.checks label {
  background: #020617;
  padding: 11px 14px;
  border-radius: 999px;
  border: 1px solid #374151;
}

.badge {
  padding: 7px 11px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: bold;
  display: inline-block;
}

.on { background: #064e3b; color: #86efac; }
.off { background: #450a0a; color: #fca5a5; }
.route-ok { background: #1e3a8a; color: #bfdbfe; }
.route-done { background: #713f12; color: #fde68a; }
.route-cancel { background: #450a0a; color: #fca5a5; }

.route-list {
  display: grid;
  gap: 12px;
  margin-top: 16px;
}

.route-item {
  background: #020617;
  border: 1px solid #263044;
  border-radius: 18px;
  padding: 16px;
}

.route-top {
  display: flex;
  justify-content: space-between;
  gap: 12px;
  flex-wrap: wrap;
}

.route-top h3 {
  margin: 0;
}

.small {
  font-size: 13px;
  color: #94a3b8;
}

.notification-btn {
  position: relative;
}

.notification-count {
  background: #dc2626;
  color: white;
  border-radius: 999px;
  padding: 2px 7px;
  font-size: 12px;
  margin-left: 6px;
}

.hidden {
  display: none !important;
}

.notice {
  background: #020617;
  border: 1px solid #263044;
  border-radius: 16px;
  padding: 14px;
  color: #cbd5e1;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr;
  gap: 10px;
}

@media (min-width: 720px) {
  .form-row.two {
    grid-template-columns: 1fr 1fr;
  }
}
</style>
</head>

<body class="locked">

<div class="app">
  <div class="header">
    <h1>Painel Admin - Repasse de Rotas</h1>
    <p>Controle motoristas, rotas, punições e repasses em tempo real.</p>
  </div>

  <div class="container">
    <div class="actions">
      <button onclick="abrirModal('modalMotorista')">+ Novo motorista</button>
      <button onclick="abrirModal('modalConsultaMotorista')">Consultar motorista</button>
      <button onclick="abrirModal('modalRota')">+ Divulgar rota</button>
      <button onclick="abrirGerenciarRotas()">Gerenciar rotas</button>
      <button class="btn-dark notification-btn" onclick="abrirNotificacoes()">🔔 Notificações <span id="notifCount" class="notification-count">0</span></button>
      <button class="btn-dark" onclick="sairAdmin()">Sair do admin</button>
    </div>

    <div class="card">
      <h2>Resumo do painel</h2>
      <p>Use os botões acima para cadastrar, consultar motoristas, divulgar rotas e gerenciar rotas já criadas.</p>
      <p class="small">A lista completa de motoristas não fica exposta para evitar lentidão e poluição visual.</p>
    </div>
  </div>
</div>

<div class="modal show" id="modalLogin">
  <div class="modal-box">
    <h2>Acesso administrativo</h2>
    <p>Informe a senha para acessar o painel de controle.</p>
    <input id="loginSenha" type="password" placeholder="Senha do admin" autocomplete="off">
    <button onclick="validarLogin()">Entrar</button>
  </div>
</div>

<div class="modal" id="modalMotorista">
  <div class="modal-box">
    <h2>Cadastrar motorista</h2>
    <p>Adicione um motorista à base.</p>
    <input id="driverId" placeholder="ID do motorista">
    <input id="driverName" placeholder="Nome do motorista">
    <select id="vehicleType">
      <option value="FIORINO">FIORINO</option>
      <option value="PASSEIO">PASSEIO</option>
      <option value="MOTO">MOTO</option>
    </select>
    <div class="modal-actions">
      <button onclick="cadastrarMotorista()">Cadastrar</button>
      <button class="btn-dark" onclick="fecharModal('modalMotorista')">Cancelar</button>
    </div>
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

<div class="modal" id="modalRota">
  <div class="modal-box">
    <h2>Divulgar rota</h2>
    <p>A rota ficará disponível apenas para os veículos selecionados.</p>
    <input id="routeName" placeholder="Rota. Ex: B-14+B-15/120">
    <input id="region" placeholder="Região. Ex: Guarulhos">

    <div class="checks">
      <label><input type="checkbox" value="FIORINO" class="vehicle"> FIORINO</label>
      <label><input type="checkbox" value="PASSEIO" class="vehicle"> PASSEIO</label>
      <label><input type="checkbox" value="MOTO" class="vehicle"> MOTO</label>
    </div>

    <div class="modal-actions">
      <button onclick="divulgarRota()">Divulgar</button>
      <button class="btn-dark" onclick="fecharModal('modalRota')">Cancelar</button>
    </div>
  </div>
</div>

<div class="modal" id="modalGerenciarRotas">
  <div class="modal-box large">
    <h2>Gerenciar rotas</h2>
    <p>Edite, reabra ou exclua rotas divulgadas.</p>
    <div id="listaRotas" class="route-list"></div>
    <div class="modal-actions">
      <button class="btn-dark" onclick="fecharModal('modalGerenciarRotas')">Fechar</button>
    </div>
  </div>
</div>

<div class="modal" id="modalEditarRota">
  <div class="modal-box">
    <h2>Editar rota</h2>
    <input id="editRouteName" placeholder="Rota">
    <input id="editRegion" placeholder="Região">

    <div class="checks">
      <label><input type="checkbox" value="FIORINO" class="editVehicle"> FIORINO</label>
      <label><input type="checkbox" value="PASSEIO" class="editVehicle"> PASSEIO</label>
      <label><input type="checkbox" value="MOTO" class="editVehicle"> MOTO</label>
    </div>

    <div class="modal-actions">
      <button onclick="salvarEdicaoRota()">Salvar edição</button>
      <button class="btn-dark" onclick="fecharModal('modalEditarRota')">Cancelar</button>
    </div>
  </div>
</div>

<div class="modal" id="modalNotificacoes">
  <div class="modal-box large">
    <h2>Notificações de rotas</h2>
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

<script>
const API = "https://truthful-acceptance-production-fb55.up.railway.app";

let ADMIN_TOKEN = localStorage.getItem("ADMIN_TOKEN") || "";
let motoristaAtual = null;
let rotaEditando = null;
let notificacoes = [];
let rotasConhecidas = new Map();
let carregandoRotasAdmin = false;

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
  return {
    "Content-Type": "application/json",
    "X-Admin-Token": ADMIN_TOKEN
  };
}

function headersGetAdmin() {
  return {
    "X-Admin-Token": ADMIN_TOKEN
  };
}

async function validarLogin() {
  ADMIN_TOKEN = loginSenha.value.trim();
  if (!ADMIN_TOKEN) return;

  const res = await fetch(API + "/admin-drivers.php", {
    headers: headersGetAdmin()
  });

  if (res.status !== 200) {
    loginSenha.value = "";
    return;
  }

  localStorage.setItem("ADMIN_TOKEN", ADMIN_TOKEN);
  document.body.classList.remove("locked");
  fecharModal("modalLogin");
  await iniciarMonitoramento();
}

async function tentarLoginSalvo() {
  if (!ADMIN_TOKEN) return;

  const res = await fetch(API + "/admin-drivers.php", {
    headers: headersGetAdmin()
  });

  if (res.status === 200) {
    document.body.classList.remove("locked");
    fecharModal("modalLogin");
    await iniciarMonitoramento();
  } else {
    localStorage.removeItem("ADMIN_TOKEN");
    ADMIN_TOKEN = "";
  }
}

function sairAdmin() {
  localStorage.removeItem("ADMIN_TOKEN");
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

async function cadastrarMotorista() {
  const body = {
    action: "create",
    driver_id: driverId.value.trim(),
    driver_name: driverName.value.trim(),
    vehicle_type: vehicleType.value
  };

  if (!body.driver_id || !body.driver_name) return;

  const res = await fetch(API + "/admin-drivers.php", {
    method: "POST",
    headers: headersAdmin(),
    body: JSON.stringify(body)
  });

  if (res.status !== 200) return;

  driverId.value = "";
  driverName.value = "";
  vehicleType.value = "FIORINO";
  fecharModal("modalMotorista");
}

async function consultarMotorista() {
  const id = consultaDriverId.value.trim();
  if (!id) return;

  const res = await fetch(API + "/admin-drivers.php?driver_id=" + encodeURIComponent(id), {
    headers: headersGetAdmin()
  });

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
  mStatus.innerHTML = d.active ? "ATIVO" : "DESATIVADO";
  mStatus.className = d.active ? "on badge" : "off badge";
  mPunicao.innerText = d.punished_until || "-";

  resultadoMotorista.style.display = "block";
}

function acaoMotoristaModal(action) {
  if (!motoristaAtual) return;

  const texto = {
    toggle: `Deseja ativar ou desativar o motorista ${motoristaAtual.driver_name}?`,
    punish: `Deseja bloquear temporariamente ${motoristaAtual.driver_name} por 15 horas?`,
    remove_punish: `Deseja remover o bloqueio temporário de ${motoristaAtual.driver_name}?`
  };

  confirmarAcao("Confirmar tratativa", texto[action], async () => {
    await fetch(API + "/admin-drivers.php", {
      method: "POST",
      headers: headersAdmin(),
      body: JSON.stringify({
        action,
        driver_id: motoristaAtual.driver_id
      })
    });

    consultarMotorista();
  });
}

async function divulgarRota() {
  const selected = [...document.querySelectorAll(".vehicle:checked")].map(c => c.value);

  if (!routeName.value.trim() || !region.value.trim() || selected.length === 0) return;

  const res = await fetch(API + "/admin-routes.php", {
    method: "POST",
    headers: headersAdmin(),
    body: JSON.stringify({
      action: "create",
      route_name: routeName.value.trim(),
      region: region.value.trim(),
      allowed_vehicles: selected
    })
  });

  if (res.status !== 200) return;

  routeName.value = "";
  region.value = "";
  document.querySelectorAll(".vehicle").forEach(c => c.checked = false);
  fecharModal("modalRota");
  atualizarBaseRotas(true);
}

async function abrirGerenciarRotas() {
  abrirModal("modalGerenciarRotas");
  await carregarRotasAdmin(true);
}

function badgeRota(status) {
  if (status === "disponivel") return "route-ok";
  if (status === "repassada") return "route-done";
  return "route-cancel";
}

function textoStatus(status) {
  if (status === "disponivel") return "DISPONÍVEL";
  if (status === "repassada") return "REPASSADA";
  if (status === "cancelada") return "CANCELADA";
  return status || "-";
}

async function buscarRotasAdmin() {
  const res = await fetch(API + "/admin-routes.php", {
    headers: headersGetAdmin()
  });

  if (res.status !== 200) return [];
  return await res.json();
}

async function carregarRotasAdmin(forcar = false) {
  if (carregandoRotasAdmin) return;
  if (!forcar && existeModalAbertoSemLogin() && !document.getElementById("modalGerenciarRotas").classList.contains("show")) return;

  carregandoRotasAdmin = true;

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
      <p><strong>Horário:</strong> ${formatarData(r.claimed_at) || "-"}</p>

      <div class="modal-actions">
        <button class="btn-dark" onclick='abrirEditarRota(${JSON.stringify(r).replace(/'/g, "&#39;")})'>Editar</button>
        <button class="btn-ok" onclick="reabrirRota(${r.id})">Reabrir rota</button>
        <button class="btn-danger" onclick="excluirRota(${r.id})">Excluir</button>
      </div>
    </div>
  `).join("") : `<div class="notice">Nenhuma rota divulgada ainda.</div>`;

  carregandoRotasAdmin = false;
}

function parseVehicles(value) {
  return String(value || "").replace("{", "").replace("}", "").split(",").map(v => v.trim()).filter(Boolean);
}

function formatarVeiculos(value) {
  const veiculos = parseVehicles(value);
  return veiculos.length ? veiculos.join(", ") : "-";
}

function formatarData(value) {
  if (!value) return "";
  try {
    return new Date(value).toLocaleString("pt-BR");
  } catch {
    return value;
  }
}

function abrirEditarRota(rota) {
  rotaEditando = rota;
  editRouteName.value = rota.route_name;
  editRegion.value = rota.region;

  const veiculos = parseVehicles(rota.allowed_vehicles);
  document.querySelectorAll(".editVehicle").forEach(c => {
    c.checked = veiculos.includes(c.value);
  });

  abrirModal("modalEditarRota");
}

async function salvarEdicaoRota() {
  const selected = [...document.querySelectorAll(".editVehicle:checked")].map(c => c.value);

  if (!rotaEditando || !editRouteName.value.trim() || !editRegion.value.trim() || selected.length === 0) return;

  await fetch(API + "/admin-routes.php", {
    method: "POST",
    headers: headersAdmin(),
    body: JSON.stringify({
      action: "edit",
      id: rotaEditando.id,
      route_name: editRouteName.value.trim(),
      region: editRegion.value.trim(),
      allowed_vehicles: selected
    })
  });

  fecharModal("modalEditarRota");
  carregarRotasAdmin(true);
  atualizarBaseRotas(true);
}

function reabrirRota(id) {
  confirmarAcao("Reabrir rota", "Essa rota voltará a ficar disponível para os motoristas.", async () => {
    await fetch(API + "/admin-routes.php", {
      method: "POST",
      headers: headersAdmin(),
      body: JSON.stringify({ action: "reopen", id })
    });
    carregarRotasAdmin(true);
    atualizarBaseRotas(true);
  });
}

function excluirRota(id) {
  confirmarAcao("Excluir rota", "Essa ação removerá a rota do sistema.", async () => {
    await fetch(API + "/admin-routes.php", {
      method: "POST",
      headers: headersAdmin(),
      body: JSON.stringify({ action: "delete", id })
    });
    carregarRotasAdmin(true);
    atualizarBaseRotas(true);
  });
}

function abrirNotificacoes() {
  notifCount.innerText = "0";
  abrirModal("modalNotificacoes");

  listaNotificacoes.innerHTML = notificacoes.length
    ? notificacoes.map(n => `
      <div class="route-item">
        <div class="route-top">
          <h3>🔔 ${n.route_name}</h3>
          <span class="badge route-done">REPASSADA</span>
        </div>
        <p><strong>Motorista:</strong> ${n.claimed_by_driver_name || "-"}</p>
        <p><strong>ID:</strong> ${n.claimed_by_driver_id || "-"}</p>
        <p><strong>Região:</strong> ${n.region || "-"}</p>
        <p><strong>Horário:</strong> ${formatarData(n.claimed_at) || "-"}</p>
      </div>
    `).join("")
    : `<div class="notice">Nenhuma notificação nova.</div>`;
}

async function atualizarBaseRotas(forcar = false) {
  if (document.body.classList.contains("locked")) return;
  if (!forcar && existeModalAbertoSemLogin()) return;

  const rotas = await buscarRotasAdmin();

  rotas.forEach(r => {
    rotasConhecidas.set(String(r.id), r);
  });
}

async function verificarNovosRepasses() {
  if (document.body.classList.contains("locked")) return;
  if (existeModalAbertoSemLogin()) return;

  const rotas = await buscarRotasAdmin();

  rotas.forEach(r => {
    const id = String(r.id);
    const antes = rotasConhecidas.get(id);

    if (antes && antes.status === "disponivel" && r.status === "repassada") {
      notificacoes.unshift(r);
      notifCount.innerText = String(notificacoes.length);
    }

    rotasConhecidas.set(id, r);
  });

  if (document.getElementById("modalGerenciarRotas").classList.contains("show")) {
    carregarRotasAdmin(true);
  }
}

async function iniciarMonitoramento() {
  await atualizarBaseRotas(true);
}

loginSenha.addEventListener("keydown", e => {
  if (e.key === "Enter") validarLogin();
});

consultaDriverId.addEventListener("keydown", e => {
  if (e.key === "Enter") consultarMotorista();
});

tentarLoginSalvo();

setInterval(verificarNovosRepasses, 15000);
</script>

</body>
</html>
