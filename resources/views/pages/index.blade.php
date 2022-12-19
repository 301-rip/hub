<x-layouts.app>
    <div x-data="url">
        <label class="sr-only" for="url">Mastadon Link to Obfuscate</label>
        <div class="flex">
            <input class="flex-grow border-t border-l border-b border-slate-300 p-2 rounded-l" placeholder="https://hachyderm.io/@301RIP" id="url" name="url" type="text" x-model="url" />
            <button class="px-4 py-2 bg-gradient-to-tl from-cyan-600 to-indigo-500 hover:from-cyan-400 hover:to-indigo-400 rounded-r text-white font-bold" @click="submit">Rip it!</button>
        </div>
    </div>

    <p class="mt-8 text-slate-500 text-sm">
        <a href="https://301.rip" class="border-dotted border-b border-black">301.rip</a> is a utility site to uncensor links to Mastadon. Paste a link to a Mastadon instance, user, or post above to get started.
    </p>

    @once
        @push('js')
            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('url', () => ({
                        url: null,

                        submit() {
                            window.location.href = `/${this.url}`;
                        }
                    }))
                })
            </script>
        @endpush
    @endonce
</x-layouts.app>
