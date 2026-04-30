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

.import-box {
  margin-top: 18px;
  padding: 16px;
  border-radius: 18px;
  border: 1px dashed #374151;
  background: #020617;
}

.import-box h3 {
  margin: 0 0 8px;
  color: #ffb199;
}

.import-box p {
  margin: 6px 0;
}

.file-input {
  border: 1px dashed #4b5563;
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


.whatsapp-link {
  display: inline-block;
  color: #86efac;
  font-weight: bold;
  text-decoration: none;
}

.whatsapp-link:hover {
  text-decoration: underline;
}

.waiting-grid {
  display: grid;
  gap: 12px;
  margin-top: 16px;
}

.waiting-item {
  background: #020617;
  border: 1px solid #263044;
  border-radius: 18px;
  padding: 16px;
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
      <button class="btn-info" onclick="abrirConfigGalpao()">Configurar galpão</button>
      <button class="btn-ok" onclick="abrirAguardandoGalpao()">Aguardando no galpão</button>
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
    <input id="driverTelephone" placeholder="Telefone/WhatsApp. Ex: 11999998888">
    <select id="vehicleType">
      <option value="FIORINO">FIORINO</option>
      <option value="PASSEIO">PASSEIO</option>
      <option value="MOTO">MOTO</option>
    </select>

    <div class="modal-actions">
      <button onclick="cadastrarMotorista()">Cadastrar</button>
      <button class="btn-dark" onclick="fecharModal('modalMotorista')">Cancelar</button>
    </div>

    <div class="import-box">
      <h3>Importar vários motoristas</h3>
      <p class="small">Aceita arquivos CSV, XLSX ou XLS com as colunas: <strong>driver_id, driver_name, vehicle_type, telephone</strong>.</p>

      <div class="modal-actions">
        <button class="btn-info" onclick="baixarModeloMotoristas()">Baixar modelo Excel</button>
      </div>

      <input class="file-input" type="file" id="arquivoMotoristas" accept=".csv,.xlsx,.xls">

      <div class="modal-actions">
        <button onclick="importarMotoristasArquivo()">Importar arquivo</button>
      </div>

      <div id="resultadoImportacao" class="result-box hidden"></div>
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


<div class="modal" id="modalConfigGalpao">
  <div class="modal-box">
    <h2>Configurar galpão</h2>
    <p>Defina a latitude, longitude e o raio permitido para registrar presença no galpão.</p>

    <input id="hubName" placeholder="Nome do galpão. Ex: Jardim Adriana">
    <input id="hubLatitude" placeholder="Latitude. Ex: -23.123456">
    <input id="hubLongitude" placeholder="Longitude. Ex: -46.123456">
    <input id="hubRadius" placeholder="Raio em metros. Ex: 300" type="number">

    <div class="modal-actions">
      <button onclick="salvarConfigGalpao()">Salvar configuração</button>
      <button class="btn-dark" onclick="fecharModal('modalConfigGalpao')">Cancelar</button>
    </div>
  </div>
</div>

<div class="modal" id="modalAguardandoGalpao">
  <div class="modal-box large">
    <h2>Motoristas aguardando no galpão</h2>
    <p>Lista dos motoristas que registraram presença dentro do raio configurado hoje.</p>
    <div id="listaAguardandoGalpao" class="waiting-grid"></div>

    <div class="modal-actions">
      <button class="btn-dark" onclick="fecharModal('modalAguardandoGalpao')">Fechar</button>
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

<script>
const API = "";


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
    "Content-Type": "application/json"
  };
}

function headersGetAdmin() {
  return {};
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
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      password: senhaDigitada
    })
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
  const res = await fetch("check-session.php");
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

async function cadastrarMotorista() {
  const body = {
    action: "create",
    driver_id: driverId.value.trim(),
    driver_name: driverName.value.trim(),
    vehicle_type: vehicleType.value,
    telephone: driverTelephone.value.trim()
  };

  if (!body.driver_id || !body.driver_name) return;

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

function normalizarTexto(valor) {
  return String(valor ?? "").trim();
}

function normalizarVeiculo(valor) {
  const v = normalizarTexto(valor).toUpperCase();
  if (v === "FIORINO" || v === "PASSEIO" || v === "MOTO") return v;
  return v;
}

function baixarModeloMotoristas() {
  const dados = [
    ["driver_id", "driver_name", "vehicle_type", "telephone"],
    ["123456", "MOTORISTA EXEMPLO", "FIORINO", "11999998888"],
    ["789012", "MOTORISTA EXEMPLO 2", "PASSEIO", "11988887777"],
    ["555888", "MOTORISTA EXEMPLO 3", "MOTO", "11977776666"]
  ];

  const ws = XLSX.utils.aoa_to_sheet(dados);
  const wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, "Motoristas");

  XLSX.writeFile(wb, "modelo_importacao_motoristas.xlsx");
}

function csvParaLinhas(texto) {
  const linhas = [];
  let atual = "";
  let linha = [];
  let dentroAspas = false;

  for (let i = 0; i < texto.length; i++) {
    const char = texto[i];
    const prox = texto[i + 1];

    if (char === '"' && dentroAspas && prox === '"') {
      atual += '"';
      i++;
      continue;
    }

    if (char === '"') {
      dentroAspas = !dentroAspas;
      continue;
    }

    if (char === "," && !dentroAspas) {
      linha.push(atual.trim());
      atual = "";
      continue;
    }

    if ((char === "\n" || char === "\r") && !dentroAspas) {
      if (char === "\r" && prox === "\n") i++;
      linha.push(atual.trim());
      if (linha.some(c => c !== "")) linhas.push(linha);
      linha = [];
      atual = "";
      continue;
    }

    atual += char;
  }

  linha.push(atual.trim());
  if (linha.some(c => c !== "")) linhas.push(linha);

  return linhas;
}

async function lerArquivoMotoristas(file) {
  const nome = file.name.toLowerCase();

  if (nome.endsWith(".csv")) {
    const texto = await file.text();
    const linhas = csvParaLinhas(texto);

    if (linhas.length < 2) return [];

    const cabecalho = linhas[0].map(c => c.trim().toLowerCase());
    const idxId = cabecalho.indexOf("driver_id");
    const idxNome = cabecalho.indexOf("driver_name");
    const idxVeiculo = cabecalho.indexOf("vehicle_type");
    const idxTelefone = cabecalho.indexOf("telephone");

    if (idxId === -1 || idxNome === -1 || idxVeiculo === -1) {
      throw new Error("O arquivo precisa ter as colunas: driver_id, driver_name, vehicle_type, telephone");
    }

    return linhas.slice(1).map(l => ({
      driver_id: normalizarTexto(l[idxId]),
      driver_name: normalizarTexto(l[idxNome]),
      vehicle_type: normalizarVeiculo(l[idxVeiculo]),
      telephone: idxTelefone >= 0 ? normalizarTexto(l[idxTelefone]) : ""
    }));
  }

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
      ["FIORINO", "PASSEIO", "MOTO"].includes(d.vehicle_type)
    );

    if (validos.length === 0) {
      resultadoImportacao.innerText = "Nenhum motorista válido encontrado no arquivo.";
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

    let texto = `Importação finalizada.\nImportados/atualizados: ${data.importados ?? 0}\nIgnorados: ${data.ignorados ?? 0}`;

    if (data.erros && data.erros.length) {
      texto += `\n\nOcorrências:\n${data.erros.slice(0, 15).join("\n")}`;
      if (data.erros.length > 15) texto += `\n...e mais ${data.erros.length - 15} ocorrência(s).`;
    }

    resultadoImportacao.innerText = texto;
    resultadoImportacao.classList.remove("hidden");
    arquivoMotoristas.value = "";

  } catch (err) {
    resultadoImportacao.innerText = err.message || "Erro ao importar arquivo.";
    resultadoImportacao.classList.remove("hidden");
  }
}


async function consultarMotorista() {
  const id = consultaDriverId.value.trim();
  if (!id) return;

  const res = await fetch("admin-drivers.php?driver_id=" + encodeURIComponent(id), {
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
  mTelefone.innerHTML = linkWhatsApp(d.telephone);
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
    await fetch("admin-drivers.php", {
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

  const res = await fetch("admin-routes.php", {
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
  const res = await fetch("admin-routes.php", {
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
      <p><strong>Veículo do motorista:</strong> ${r.status === "repassada" ? (r.claimed_vehicle_type || "-") : "-"}</p>
      <p><strong>Telefone:</strong> ${r.status === "repassada" ? linkWhatsApp(r.claimed_telephone) : "-"}</p>
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

  await fetch("admin-routes.php", {
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
    await fetch("admin-routes.php", {
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
    await fetch("admin-routes.php", {
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
        <p><strong>Veículo do motorista:</strong> ${n.claimed_vehicle_type || "-"}</p>
        <p><strong>Telefone:</strong> ${linkWhatsApp(n.claimed_telephone)}</p>
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


async function abrirConfigGalpao() {
  abrirModal("modalConfigGalpao");

  const res = await fetch("hub-config.php", {
    headers: headersGetAdmin()
  });

  if (res.status !== 200) return;

  const cfg = await res.json();

  hubName.value = cfg.hub_name || "";
  hubLatitude.value = cfg.latitude || "";
  hubLongitude.value = cfg.longitude || "";
  hubRadius.value = cfg.radius_meters || "";
}

async function salvarConfigGalpao() {
  const body = {
    hub_name: hubName.value.trim(),
    latitude: hubLatitude.value.trim(),
    longitude: hubLongitude.value.trim(),
    radius_meters: hubRadius.value.trim()
  };

  if (!body.hub_name || !body.latitude || !body.longitude || !body.radius_meters) return;

  const res = await fetch("hub-config.php", {
    method: "POST",
    headers: headersAdmin(),
    body: JSON.stringify(body)
  });

  if (res.status !== 200) return;

  fecharModal("modalConfigGalpao");
}

async function abrirAguardandoGalpao() {
  abrirModal("modalAguardandoGalpao");
  await carregarAguardandoGalpao();
}

async function carregarAguardandoGalpao() {
  const res = await fetch("admin-waiting.php", {
    headers: headersGetAdmin()
  });

  if (res.status !== 200) return;

  const lista = await res.json();

  listaAguardandoGalpao.innerHTML = lista.length ? lista.map(m => `
    <div class="waiting-item">
      <div class="route-top">
        <h3>${m.driver_name}</h3>
        <span class="badge on">AGUARDANDO</span>
      </div>
      <p><strong>ID:</strong> ${m.driver_id}</p>
      <p><strong>Veículo:</strong> ${m.vehicle_type}</p>
      <p><strong>Telefone:</strong> ${linkWhatsApp(m.telephone)}</p>
      <p><strong>Distância:</strong> ${Math.round(Number(m.distance_meters || 0))}m do galpão</p>
      <p><strong>Horário:</strong> ${formatarData(m.created_at)}</p>
    </div>
  `).join("") : `<div class="notice">Nenhum motorista aguardando no galpão hoje.</div>`;
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
