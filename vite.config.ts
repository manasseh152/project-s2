import { defineConfig } from "vite";
import liveReload from "vite-plugin-live-reload";
import path from "path";

export default defineConfig({
	root: "./resources",
	base: "/",
	plugins: [liveReload("./resources/views/**/*.twig")],
	build: {
		outDir: "../public/dist",
		emptyOutDir: true,
		assetsDir: "./assets",
		manifest: true,
		rollupOptions: {
			input: {
				main: "./resources/ts/main.ts",
			},
		},
	},
	resolve: {
		alias: {
			"@": path.resolve(__dirname, "resources"),
		},
	},
	server: {
		cors: true,
	},
});
