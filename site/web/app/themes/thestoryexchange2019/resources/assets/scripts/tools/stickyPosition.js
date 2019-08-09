import {throttle} from 'lodash';
import eventLoader from '../util/eventLoader';
const EVENTS = [
  'scroll',
  'resize',
];

export default function stickyPosition(selectors, eventTarget = window) {
  const elements = Array.from(document.querySelectorAll(selectors));
  const loader = eventLoader(EVENTS, eventTarget);

  return stickyClassBase => {
    const placeholderClass = `${stickyClassBase}__placeholder`;
    const placeholderElements = elements.map(el => {
      const placeholder = document.createElement('div');

      placeholder.classList.add(placeholderClass);

      return [placeholder, el];
    });

    const insertPlaceholder = ([p, el]) => el.insertAdjacentElement('afterEnd', p);
    const removePlaceholder = ([p]) => p.remove()

    const updater = () => {
      placeholderElements.forEach(([placeholder, el]) => {
        const elHasClass = el.classList.contains(stickyClassBase);
        const {y, height} = (elHasClass ? placeholder : el).getBoundingClientRect();

        if (elHasClass && y > 0) {
            el.classList.remove(stickyClassBase);
            placeholder.style.height = 0;
        } else if (!elHasClass && y <= 0) {
          el.classList.add(stickyClassBase);
          placeholder.style.height = `${height}px`;
        }
      })
      // tell elements positioning
    };

    const [install, uninstall] = loader(throttle(updater, 50));

    return {
      init: () => {
        install();
        placeholderElements.forEach(insertPlaceholder);
      },
      destroy: () => {
        uninstall()
        placeholderElements.forEach(removePlaceholder);
      },
    }
  }
}
