document.addEventListener("DOMContentLoaded", async () => {
    try {
        const sessionToken = await getSessionToken();
        await populatePersonalOptions(await fetchPersonals(sessionToken.token));
        showData(await fetchData(sessionToken.token));
    } catch (error) {
        handleError(error);
    }
});

async function fetchPersonals(token) {
    const response = await fetch(`${apiUrl}personals/get_personal_all.php`, {
        headers: { 'Authorization': `Bearer ${token}` }
    });
    return response.json();
}

function populatePersonalOptions(data) {
    const personalSelect = document.getElementById('select_personal');
    const id = getQueryParam('id');

    if (data.status === 'success') {
        data.data.forEach(({ id: personalId, mem_fullname }) => {
            const option = new Option(mem_fullname, personalId, personalId === id, personalId === id);
            personalSelect.appendChild(option);
        });
    } else {
        handleError(data.message);
    }
}

async function fetchData(token) {
    const id = getQueryParam('id');
    const month = getQueryParam('month');
    const year = getQueryParam('year');

    const response = await fetch(`${apiUrl}time_attendances/get_time_attendance.php?id=${id}&month=${month}&year=${year}`, {
        headers: { 'Authorization': `Bearer ${token}` }
    });
    return response.json();
}

function showData(datas) {
    const month = document.getElementById('select_month').value;
    const year = document.getElementById('select_year').value;
    const daysInMonth = new Date(year, month, 0).getDate();

    let html = '';

    for (let day = 1; day <= daysInMonth; day++) {
        const date = new Date(year, month - 1, day);
        const formattedDate = new Intl.DateTimeFormat('th-TH', { day: 'numeric', month: 'long', year: 'numeric' }).format(date);

        let dataForDay = datas.status === 'success' ? datas.data.find(data => new Date(data.date).getDate() === day) : null;

        html += `<tr>
                    <td>${formattedDate}</td>
                    <td>${dataForDay?.time_in ? new Date(dataForDay.time_in).toLocaleTimeString('th-TH') + ' น.' : ''}</td>
                    <td>${dataForDay?.time_out ? new Date(dataForDay.time_out).toLocaleTimeString('th-TH') + ' น.' : ''}</td>
                 </tr>`;
    }

    document.querySelector('tbody').innerHTML = html;
}

document.getElementById('search_button').addEventListener('click', () => {
    const Id = document.getElementById('select_personal').value;
    const month = document.getElementById('select_month').value;
    const year = document.getElementById('select_year').value;

    if (Id && month && year) {
        window.location.href = `time_attendance.php?id=${Id}&month=${month}&year=${year}`;
    } else {
        alert('กรุณาเลือกผู้ใช้');
    }
});
