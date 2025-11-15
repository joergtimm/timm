import { startStimulusApp } from '@symfony/stimulus-bundle';
import Clipboard from '@stimulus-components/clipboard'
import Glow from 'stimulus-glow'
import CheckboxSelectAll from '@stimulus-components/checkbox-select-all'
import ScrollProgress from '@stimulus-components/scroll-progress'

const app = startStimulusApp();
app.register('scroll-progress', ScrollProgress)
app.register('checkbox-select-all', CheckboxSelectAll)
app.register('glow', Glow)
app.register('clipboard', Clipboard)
