<form action="{{ route('chat.chat', $user->id) }}" class="flex items-center justify-center" method="post">
    @csrf
    <button class="auth-button">
        Message
    </button>
</form>
