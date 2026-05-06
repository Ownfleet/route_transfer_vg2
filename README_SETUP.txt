SISTEMA NOVO BASEADO NO ANTERIOR - PHP + SUPABASE

1) Supabase:
   Rode schema_supabase.sql no SQL Editor.

2) Backend PHP:
   Configure:
   ADMIN_PASSWORD=sua_senha_admin
   DATABASE_URL=postgresql://USER:SENHA@HOST:5432/postgres

   ou:
   PGHOST=
   PGPORT=5432
   PGDATABASE=postgres
   PGUSER=
   PGPASSWORD=

3) index.html:
   Troque:
   const API = "https://COLOQUE-SEU-BACKEND-PHP-AQUI";
   pelo link onde os PHPs estão hospedados.

4) Supabase usado no realtime:
   https://yewfqmgmphswqvpuhfin.supabase.co

5) Mantido do sistema anterior:
   motoristas, telefone, importação, punição, ativar/desativar,
   rotas por veículo, pegar rota com trava, admin, galpão, mapa,
   WhatsApp, notificações e realtime.
