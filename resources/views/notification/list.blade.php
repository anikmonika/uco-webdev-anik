<x-template>
    <h3 class="mb-3">Notifications</h3>
    <div class="list-group">
        @foreach ($notifications as $notification)
        <a href="{{ route('notification.read', ['notification_id' => $notification->id]) }}" class="list-group-item list-group-item-action @if($notification->read_at) bg-light @endif">
            {{ $notification->data['text'] }}
        </a>
        @endforeach
    </div>
</x-template>