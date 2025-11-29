@once
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@5.0.10/dist/signature_pad.umd.min.js"></script>
    <script>
        window.signaturePadComponent = function(params = {}) {
            return {
                state: params.state ?? null,
                pad: null,

                init() {
                    const canvas = this.$refs.canvas;
                    this.pad = new SignaturePad(canvas, {
                        penColor: "#144faeff"
                    });

                    const resize = () => {
                        const ratio = Math.max(window.devicePixelRatio || 1, 1);
                        const rect = canvas.getBoundingClientRect();

                        canvas.style.width = `${rect.width}px`;
                        canvas.style.height = `${rect.height}px`;
                        canvas.width = rect.width * ratio;
                        canvas.height = rect.height * ratio;

                        canvas.getContext("2d").setTransform(ratio, 0, 0, ratio, 0, 0);

                        if (this.state?.startsWith("data:image")) {
                            this.pad.fromDataURL(this.state);
                        }
                    };

                    resize();

                    this.pad.addEventListener("endStroke", () => {
                        this.state = this.pad.isEmpty() ? null : this.pad.toDataURL("image/png");
                    });

                    window.addEventListener("resize", () => {
                        clearTimeout(this.resizeTimeout);
                        this.resizeTimeout = setTimeout(resize, 150);
                    });

                    this.$watch("state", (val) => {
                        if (!val) this.pad.clear();
                    });
                },

                clear() {
                    this.pad.clear();
                    this.state = null;
                },
            };
        };
    </script>
@endonce

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="signaturePadComponent({ state: $wire.$entangle(@js($getStatePath())) })" {{ $getExtraAttributeBag() }}>
        <div wire:ignore style="display: flex; align-items: flex-start; gap: 12px;">
            <canvas x-ref="canvas"
                style="border: 2px solid #dfdfdfff; border-radius: 0.5rem; background-color: white;"></canvas>

            <x-filament::button type="button" color="gray" @click="clear">
                Limpiar
            </x-filament::button>
        </div>
    </div>
</x-dynamic-component>
