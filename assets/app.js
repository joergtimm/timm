import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import { initFlowbite } from 'flowbite';
import {performTransition, shouldPerformTransition} from 'turbo-view-transitions';

document.addEventListener("turbo:before-render", (event) => {
    if (shouldPerformTransition()) {
        event.preventDefault();

        performTransition(document.body, event.detail.newBody, async () => {
            await event.detail.resume();
        });
    }
});

document.addEventListener("turbo:load", () => {
    // View Transitions don't play nicely with Turbo cache
    if (shouldPerformTransition()) Turbo.cache.exemptPageFromCache();

    // Re-initialize Flowbite components (e.g. collapse, dropdown) after Turbo renders a new page
    // This fixes sidebar dropdowns not expanding when navigating via Turbo
    initFlowbite();
});

// Fallback: ensure Flowbite is initialized on first page load as well
document.addEventListener('DOMContentLoaded', () => {
    initFlowbite();
});
