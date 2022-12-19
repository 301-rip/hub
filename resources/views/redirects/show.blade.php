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
<div class="absolute inset-0 overflow-hidden flex items-center justify-center bg-gray-100 space-x-4">
	<div x-data="rip({{ $url }})">
		<div class="hidden" :class="{ hidden: !ripped }">
			<div x-text="timer"></div>
			<div x-text="ripped ? url : null"></div>
		</div>
		<div class="hidden" :class="{ hidden: ripped }">
			You cool?
			<button class="bg-gray-300 rounded p-2" @click="iscool()">
				Not a cop
			</button>
		</div>
	</div>
</div>
<script>
document.addEventListener('alpine:init', () => {
	Alpine.data('rip', (obfuscated) => ({
		timer: 4,
		ripped: false,
		url: atob(obfuscated.join('')),
		init() {
			this.ripped = 'yes' === localStorage.getItem('ripped');
			if (this.ripped) {
				this.countdown();
			}
		},
		countdown() {
			if (0 === this.timer) {
				window.location.href = this.url;
				return;
			}
			
			this.timer--;
			setTimeout(() => this.countdown(), 1000);
		},
		iscool() {
			localStorage.setItem('ripped', 'yes');
			this.ripped = true;
			this.countdown();
		},
	}));
});
</script>
</body>
</html>
