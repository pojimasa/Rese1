document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.querySelector('input[type="date"]');
    const timeInput = document.querySelector('input[type="time"]');
    const numberSelect = document.querySelector('select[name="number"]');
    
    const selectedDateSpan = document.getElementById('selected-date');
    const selectedTimeSpan = document.getElementById('selected-time');
    const selectedNumberSpan = document.getElementById('selected-number');

    dateInput.addEventListener('change', function() {
        selectedDateSpan.textContent = dateInput.value;
    });

    timeInput.addEventListener('change', function() {
        selectedTimeSpan.textContent = timeInput.value;
    });

    numberSelect.addEventListener('change', function() {
        selectedNumberSpan.textContent = numberSelect.value + '人';
    });
});
