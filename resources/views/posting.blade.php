<x-app-layout>
  <head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        memo
        </h2>
    </x-slot>
    @livewireStyles
  </head>
<body>
  
@livewire('CreatePost')

@livewireScripts
</body>
</x-app-layout>