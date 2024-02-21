import VanillaCalendar from "vanilla-calendar-pro";
import 'vanilla-calendar-pro/build/vanilla-calendar.min.css';

export default function vanillaCalendarPicker({
    state,
    isLive,
    isLiveDebounced,
    isLiveOnBlur,
    liveDebounce,
    type,
    months,
    jumpMonths,
    date,
    settings,
    locale,
})  {
        return {
            state,
            vanillaCalendar: null,
            currentCalendarInstance: null,

            init: function () {
                if (!(this.state === null || this.state === '')) {
                    this.setState(this.state)
                }

                const options = {
                    type: type,
                    months: months,
                    jumpMonths: jumpMonths,
                    date: date,
                    settings: settings,
                    locale: locale,
                    input: true,
                    actions: {
                        changeToInput: (event, calendar, self) => {
                            if (!self.HTMLInputElement) return

                            this.currentCalendarInstance = calendar

                            if (self.selectedDates[0]) {
                                self.HTMLInputElement.value = self.selectedDates[0]
                                this.currentCalendarInstance.hide();
                            } else {
                                self.HTMLInputElement.value = ''
                            }
                        },

                        clickDay: (event, self) => {
                            this.prepareState(self.selectedDates, self.selectedTime)

                            this.currentCalendarInstance?.hide()
                        },

                        changeTime: (event, self) => {
                            this.prepareState(self.selectedDates, self.selectedTime)
                        },
                    },
                };

                if (isLive || isLiveDebounced || isLiveOnBlur) {
                    new MutationObserver(() => this.isOpen() ? null : this.commitState()).observe(this.$refs.vanillaCalendar, {
                        attributes: true,
                        childList: true,
                    })
                }

                this.vanillaCalendar = new VanillaCalendar(this.$refs.vanillaCalendar, options);
                this.vanillaCalendar.init();
            },

            prepareState: function (selectedDates, selectedTime) {
                let date = typeof selectedDates !== 'undefined' && selectedDates.length > 0 ? selectedDates[0] : this.currentDate();
                let time = typeof selectedTime !== 'undefined' ? selectedTime : new Date().getHours();
                let selectedDateTime = `${date} ${time}`;

                this.setState(selectedDateTime)

                if (isLiveOnBlur || (! (isLive || isLiveDebounced))) {
                    return
                }

                setTimeout(() => {
                    if (this.state !== selectedDateTime) {
                        return
                    }

                    this.commitState()
                }, isLiveDebounced ? liveDebounce : 250)
            },

            currentDate: function () {
                return new Date().toISOString().slice(0, 10)
            },

            setState: function (value) {
                this.state = value

                this.$refs.vanillaCalendar.value = value
            },

            isOpen: function () {
                let calendar = document.querySelector('.vanilla-calendar');

                if (typeof calendar === 'undefined') {
                    return false;
                }

                return calendar.classList.contains('vanilla-calendar_hidden');
            },

            commitState: function () {
                if (JSON.stringify(this.$wire.__instance.canonical) === JSON.stringify(this.$wire.__instance.ephemeral)) {
                    return
                }

                this.$wire.$commit()
            },
        }
    }
