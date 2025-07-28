<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">Guía de Configuración DNS</h2>
  </x-slot>

  <div class="p-6 bg-white shadow rounded" x-data="{ provider: '' }">
    <p class="mb-4">Selecciona tu proveedor de dominios para ver los pasos de configuración:</p>
    <select x-model="provider"
            class="border rounded p-2 mb-6 w-full max-w-sm">
      <option value="" disabled selected>— Elige proveedor —</option>
      <option value="godaddy">GoDaddy</option>
      <option value="domaincontrol">DomainControl</option>
      <option value="cloudflare">Cloudflare</option>
      <option value="route53">AWS Route 53</option>
      <option value="otro">Otro</option>
    </select>

    {{-- GoDaddy --}}
    <div x-show="provider==='godaddy'" class="space-y-4">
      <h3 class="font-bold">GoDaddy</h3>
      <ol class="list-decimal list-inside">
        <li>Inicia sesión en tu cuenta de GoDaddy.</li>
        <li>En el menú “Mis Productos”, haz clic en “DNS” junto a tu dominio.</li>
        <li>Agrega o edita estos registros:</li>
        <ul class="list-disc list-inside ml-6">
          <li><strong>MX</strong> – Host: @, Valor: mail.connectia.info, Prioridad: 10</li>
          <li><strong>TXT</strong> – Host: @, Valor: <code>v=spf1 mx ~all</code></li>
          <li><strong>TXT</strong> – Host: default._domainkey, Valor: tu registro DKIM (p.ej. <code>v=DKIM1; k=rsa; p=MIIBIj...</code>)</li>
          <li><strong>TXT</strong> – Host: _dmarc, Valor: <code>v=DMARC1; p=none; rua=mailto:info@connectia.info; pct=100</code></li>
        </ul>
        <li>Guarda los cambios y espera hasta 30 minutos por la propagación.</li>
      </ol>
    </div>

    {{-- DomainControl --}}
    <div x-show="provider==='domaincontrol'" class="space-y-4">
      <h3 class="font-bold">DomainControl (Namecheap, HostGator, etc.)</h3>
      <ol class="list-decimal list-inside">
        <li>Entra al panel de tu registrador y busca “Gestión DNS” o “Zone Editor”.</li>
        <li>Inserta estos registros:</li>
        <ul class="list-disc list-inside ml-6">
          <li><strong>MX</strong> – @ → mail.connectia.info, prioridad 10</li>
          <li><strong>TXT</strong> – @ → <code>v=spf1 mx ~all</code></li>
          <li><strong>TXT</strong> – default._domainkey → tu clave DKIM</li>
          <li><strong>TXT</strong> – _dmarc → <code>v=DMARC1; p=none; rua=mailto:info@connectia.info; pct=100</code></li>
        </ul>
        <li>Guarda y espera la propagación.</li>
      </ol>
    </div>

    {{-- Cloudflare --}}
    <div x-show="provider==='cloudflare'" class="space-y-4">
      <h3 class="font-bold">Cloudflare</h3>
      <ol class="list-decimal list-inside">
        <li>Accede a tu panel de Cloudflare y selecciona tu dominio.</li>
        <li>Ve a la pestaña “DNS”.</li>
        <li>Asegúrate de que el proxy (nube) esté <strong>desactivado</strong> para estos registros.</li>
        <li>Crea o edita:</li>
        <ul class="list-disc list-inside ml-6">
          <li>MX: Nombre: @, Servidor de correo: mail.connectia.info, Prioridad: 10</li>
          <li>TXT: @ → <code>v=spf1 mx ~all</code></li>
          <li>TXT: default._domainkey → tu clave DKIM</li>
          <li>TXT: _dmarc → <code>v=DMARC1; p=none; rua=mailto:info@connectia.info; pct=100</code></li>
        </ul>
        <li>Haz clic en “Guardar”.</li>
      </ol>
    </div>

    {{-- Route 53 --}}
    <div x-show="provider==='route53'" class="space-y-4">
      <h3 class="font-bold">AWS Route 53</h3>
      <ol class="list-decimal list-inside">
        <li>Desde la consola AWS, ve a Route 53 → Zonas alojadas.</li>
        <li>Selecciona tu dominio y haz clic en “Crear registro”.</li>
        <li>Agrega:</li>
        <ul class="list-disc list-inside ml-6">
          <li>Tipo MX: Archivo JSON con <code>[{"Value":"10 mail.connectia.info"}]</code></li>
          <li>Tipo TXT: <code>"v=spf1 mx ~all"</code></li>
          <li>Tipo TXT: Nombre: <code>default._domainkey</code>, valor: tu clave DKIM</li>
          <li>Tipo TXT: Nombre: <code>_dmarc</code>, valor: <code>"v=DMARC1; p=none; rua=mailto:info@connectia.info; pct=100"</code></li>
        </ul>
      </ol>
    </div>

    {{-- Otro --}}
    <div x-show="provider==='otro'" class="space-y-4">
      <h3 class="font-bold">Otro proveedor</h3>
      <p>Los pasos son muy similares en cualquier panel DNS:</p>
      <ol class="list-decimal list-inside">
        <li>Entra al panel de gestión DNS de tu registrador.</li>
        <li>Busca “Editor de zona” o “Gestión DNS”.</li>
        <li>Crea o edita estos registros:</li>
        <ul class="list-disc list-inside ml-6">
          <li><strong>MX</strong>: Host: <code>@</code>, valor: <code>mail.connectia.info</code>, prioridad <code>10</code></li>
          <li><strong>SPF</strong>: Tipo TXT, Host: <code>@</code>, valor: <code>v=spf1 mx ~all</code></li>
          <li><strong>DKIM</strong>: Tipo TXT, Host: <code>default._domainkey</code>, valor: tu clave DKIM generada (p.ej. <code>v=DKIM1; k=rsa; p=MIIBI…</code>)</li>
          <li><strong>DMARC</strong>: Tipo TXT, Host: <code>_dmarc</code>, valor: <code>v=DMARC1; p=none; rua=mailto:info@connectia.info; pct=100</code></li>
        </ul>
        <li>Guarda y espera la propagación (hasta 1 hora en la mayoría de paneles).</li>
      </ol>
    </div>
  </div>
</x-app-layout>
