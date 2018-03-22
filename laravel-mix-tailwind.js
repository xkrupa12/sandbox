let mix = require('laravel-mix');

class Tailwind {
    dependencies() {
        this.requiresReload = 'Please, run `node_modules/.bin/tailwind init` to create Tailwind configuration file';

        return['tailwindcss'];
    }

    register(configPath = './tailwind.js') {
        this.configPath = configPath;
    }

    boot() {
        if (Mix.components.has('sass')) {
            Config.processCssUrls = false;
        }

        let tailwindcss = require('tailwindcss');

        Config.postCss.push(tailwindcss('./tailwind.js'));
    }
}

mix.extend('tailwind', new Tailwind());