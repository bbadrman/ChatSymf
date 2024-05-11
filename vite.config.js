// @ts-check
import prefresh from "@prefresh/vite";
import { resolve } from 'path'

const root = "./assets";

/**
 * @type { import('vite').UserConfig }
 */
const config = {
  resolve: {
    alias: {
      react: "preact/compat",
      "react-dom": "preact/compat",
    }
  },
  emitManifest: true,
  cors: true,
  optimizeDeps: {
    include: ['preact/hooks', 'preact/compat']
  },
  esbuild: {
    jsxFactory: 'h',
    jsxFragment: 'Fragment',
    jsxInject: `import { h, Fragment } from 'preact'`
  },
  base: '/assets/',
  build: {
    polyfillDynamicImport: false,
    assetsDir: '',
    manifest: true,
    outDir: '../public/assets/',
    rollupOptions: {
      output: {
        manualChunks: undefined
      },
      input: {
        app: resolve(__dirname, 'assets/app.js'),
      }
    },
  },
  plugins: [prefresh()],
  root
};

module.exports = config;