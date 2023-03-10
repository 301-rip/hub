<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>rip</title>
	<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
	@vite(['resources/css/app.css'])
</head>
<body class="m-0 p-0">
<div class="absolute inset-0 overflow-hidden bg-green-600 text-white p-8 space-y-6 md:flex md:items-center md:p-0 md:space-y-0 md:space-x-4">
	<div class="flex-1 md:text-right">
		<h1 class="text-xs opacity-50 lg:text-sm xl:text-base">
			Original
		</h1>
		<div class="text-base lg:text-xl xl:text-3xl">
			{{ $original }}
		</div>
	</div>
	<div class="flex-shrink-0 hidden md:block">
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
			<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
		</svg>
	</div>
	<div class="flex-1">
		<h1 class="text-xs opacity-50 lg:text-sm xl:text-base">
			RIP
		</h1>
		<div class="inline-flex">
			<div class="text-base lg:text-xl xl:text-3xl">
				{{ $rip }}
			</div>
			<button
				x-data="copyToClipboard(@js($rip))"
				class="hidden"
				:class="{ hidden: !supported }"
				@click="copy()"
			>
				<svg
					xmlns="http://www.w3.org/2000/svg"
					fill="none"
					viewBox="0 0 24 24"
					stroke-width="1.5"
					stroke="currentColor"
					class="w-5 h-5 ml-2 top-0.5 relative"
				>
					<path
						stroke-linecap="round"
						stroke-linejoin="round"
						d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z"
						:class="{ hidden: copied }"
					/>
					<path
						stroke-linecap="round"
						stroke-linejoin="round"
						d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75"
						class="hidden"
						:class="{ hidden: !copied }"
					/>
				</svg>
			</button>
		</div>
	</div>
</div>
<script>
document.addEventListener('alpine:init', () => {
	// See: https://github.com/zenorocha/clipboard.js
	Alpine.data('copyToClipboard', (text) => ({
		copied: false,
		supported: (!!document.queryCommandSupported && !!document.queryCommandSupported('copy')),
		copy() {
			if (!this.supported) {
				return;
			}
			
			const element = document.createElement('textarea');
			
			// Prevent zooming on iOS
			element.style.fontSize = '12pt';
			
			// Reset box model
			element.style.border = '0';
			element.style.padding = '0';
			element.style.margin = '0';
			
			// Move element out of screen horizontally
			element.style.position = 'absolute';
			element.style['left'] = '-9999px';
			
			// Move element to the same position vertically
			let yPosition = window.pageYOffset || document.documentElement.scrollTop;
			element.style.top = `${ yPosition }px`;
			
			element.setAttribute('readonly', '');
			element.value = text;
			
			document.body.appendChild(element);
			
			element.select();
			element.setSelectionRange(0, text.length);
			
			document.execCommand('copy');
			
			element.remove();
			
			this.copied = true;
			setTimeout(() => this.copied = false, 1500);
		}
	}));
});
</script>
</body>
</html>
