<x-app-layout>
    <x-slot name="header" :recipient="$recipient">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          所得計算：{{ $recipient->name }}
      </h2>
    </x-slot>

    <livewire:calculation :recipient="$recipient" :income_type_categories="$income_type_categories">

  </x-app-layout>  