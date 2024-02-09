
@extends('Frames.app')
@section('content')
<livewire:component.interaction-livewire />
<script>
    // Refresh the page or Livewire component after 10 seconds
    setTimeout(function () {
        window.location.reload(); // or Livewire.reload() if you want to reload only the Livewire component
    }, 200000); // 10000 milliseconds = 10 seconds
</script>
@endsection


