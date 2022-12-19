<x-layouts.app>
    <h1>301.rip</h1>
    <h2>A distributed solution to de-censoring links to Mastadon.</h2>

    <div x-data="url">
        <label for="url">Mastadon Link to Obfuscate</label>
        <input id="url" name="url" type="text" x-model="url" />

        <button @click="submit">Submit</button>
    </div>

    @once
        @push('js')
            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('url', () => ({
                        url: null,

                        submit() {
                            segments = this.url.split('//')
                            url_for_server = segments.length > 1 ? segments[1] : segments[0]

                            window.location.href = route('redirect', url_for_server)
                        }
                    }))
                })
            </script>
        @endpush
    @endonce
</x-layouts.app>
