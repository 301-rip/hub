<x-layouts.app>
    <form x-data="url" @submit.prevent="submit()">
        <label class="sr-only" for="url">Mastadon Link to Obfuscate</label>
        <div class="mt-1 flex rounded-md shadow-sm">
            <div class="relative flex flex-grow items-stretch focus-within:z-10">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-heroicon-s-link class="h-5 w-5 text-gray-400"/>
                </div>
                <input
                    class="block w-full rounded-none rounded-l-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    pattern="([Hh][Tt]{2}[Pp][Ss]?:\/\/)?([\w\-]+\.)+([a-zA-Z]{2,63})(\/.*)?"
                    placeholder="https://hachyderm.io/@301RIP"
                    id="url"
                    name="url"
                    type="text"
                    x-model="url"
                    autofocus
                    required
                />
            </div>
            <button
                type="submit"
                class="relative -ml-px inline-flex items-center rounded-r-md border border-gray-300 bg-gradient-to-tl from-cyan-600 to-indigo-500 text-white px-4 py-2 text-sm font-medium hover:from-cyan-400 hover:to-indigo-400 focus:border-indigo-400 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:from-cyan-200 focus:to-indigo-300 disabled:from-gray-200 disabled:to-gray-100"
                :disabled="!valid()"
            >
                <span class="sr-only">Submit</span>
                <x-heroicon-s-arrow-right class="w-5 h-5" />
            </button>
        </div>
        <div class="hidden m-1 text-sm font-semibold text-red-600" :class="{ hidden: valid() || '' === url }" x-text="error()"></div>
    </form>

    <p class="mt-8 text-slate-500 text-sm">
        <a href="https://301.rip" class="border-dotted border-b border-black">301.rip</a> is a utility site to uncensor
        links to Mastadon. Paste a link to a Mastadon instance, user, or post above to get started. Built by
        <a href="https://hachyderm.io/@coulb" class="font-semibold hover:underline" rel="me" target="_blank">Daniel</a>
        and <a href="https://jawns.club/@inxilpro" class="font-semibold hover:underline" rel="me" target="_blank">Chris</a>.
    </p>

    @once
        @push('js')
            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('url', () => ({
                        url: '',
                        init() {
                            this.valid();
                        },
                        valid() {
                            return `${this.url}`.match(/^([Hh][Tt]{2}[Pp][Ss]?:\/\/)?([\w\-]+\.)+([a-zA-Z]{2,63})(\/.*)?/);
                        },
                        error() {
                            return `Please enter a valid URL.`;
                        },
                        submit() {
                            window.location.href = `/${this.url}`;
                        }
                    }))
                })
            </script>
        @endpush
    @endonce
</x-layouts.app>
