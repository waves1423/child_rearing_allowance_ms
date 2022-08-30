<div class="p-2 w-full flex justify-around mt-4">
    <form id="delete_{{ $recipient->id }}" method="POST" action="{{ route('admin.recipients.destroy', ['recipient' => $recipient->id]) }}">
      @csrf
      @method('delete')
      <div class="flex justify-center items-center">
          <a href="#" data-id="{{ $recipient->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded">削除する</a>
      </div>
    </form>
</div>
<script>
    function deletePost(e) {
      'use strict';
      if (confirm('本当に削除しますか?')) {
        document.getElementById('delete_' + e.dataset.id).submit(); 
      }
    }
</script>