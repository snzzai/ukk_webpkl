<div class= "bg-gradient-to-r from-[#F9FBE7] to-[#F0EDD4] border-b border-[#ECCDB4]; min-height: 100vh;">
    <x-layouts.app>
        <flux:heading size="xl" level="1" class="text-center">{{ __('Tabel Status Laporan PKL') }}</flux:heading>
        <flux:subheading size="lg" class="mb-4" class="text-center">{{ __('Pantau status PKL disini') }}</flux:subheading>

        <flux:separator variant="subtle" class="my-2" />

        <livewire:pkl.index />
    </x-layouts.app>
</div>