<x-mail::message>
# Olá, {{ $order->user->name }}!

{{ $messageContent }}

**Detalhes do Pedido:**
- **Produto:** {{ $order->product_name }}
- **Valor:** R$ {{ number_format($order->amount, 2, ',', '.') }}
- **Status:** {{ strtoupper($order->status) }}

Obrigado por comprar connosco!
<br>
{{ config('app.name') }}
</x-mail::message>