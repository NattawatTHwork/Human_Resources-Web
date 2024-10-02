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

    const response = await fetch(`${apiUrl}events/get_event_by_personal.php?personal_id=${id}`, {
        headers: { 'Authorization': `Bearer ${token}` }
    });
    return response.json();
}

function showData(datas) {
    let html = '';
    for (const data of datas.data) {
        html += '<tr>';
        html += `<td>${data.event_name}</td>
                <td>${new Date(data.event_date).toLocaleDateString('th-TH', { year: 'numeric', month: 'long', day: 'numeric' })}</td>
                <td>${new Date(data.event_date_to).toLocaleDateString('th-TH', { year: 'numeric', month: 'long', day: 'numeric' })}</td>
                <td>${data.percent + '%'}</td>
                <td>
                    <button class="btn ${data.status == 'Inprogress' ? 'btn-danger' : 'btn-success'}">
                        ${data.status == 'Inprogress' ? 'กำลังดำเนินการ' : 'เสร็จสิ้น'}
                    </button>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ตัวเลือก
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="view_data('${data.event_id}')">ดูข้อมูล</a></li>
                            <li><a class="dropdown-item" href="${pathUrl}events/event_detail.php?event_id=${data.event_id}&personal_id=${data.personal_id}">ดูความคืบหน้า</a></li>
                        </ul>
                    </div>
                </td>`;
        html += '</tr>';
    }

    document.querySelector('tbody').innerHTML = html;
    $(document).ready(function () {
        $('#datatables').DataTable({
            "order": []
            // "scrollX": true
        });
    });
}

document.getElementById('search_button').addEventListener('click', () => {
    const Id = document.getElementById('select_personal').value;

    if (Id) {
        window.location.href = `event.php?id=${Id}`;
    } else {
        alert('กรุณาเลือกผู้ใช้');
    }
});

function view_data(event_id) {
    getSessionToken()
        .then(mySession => {
            fetch(apiUrl + 'events/get_event_by_event.php?event_id=' + event_id, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${mySession.token}`
                }
            })
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    show_data(data.data);
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        })
        .catch(error => console.error('Error fetching session token:', error));

    function show_data(datas) {
        $("#event_name_view").val(datas.event_name);
        $("#event_detail_view").val(datas.event_detail);
        $("#event_date_view").val(new Date(datas.event_date).toLocaleDateString('th-TH', { year: 'numeric', month: 'long', day: 'numeric' }));
        $("#event_date_to_view").val(new Date(datas.event_date_to).toLocaleDateString('th-TH', { year: 'numeric', month: 'long', day: 'numeric' }));
        $("#percent_view").val(datas.percent + '%');
        $("#status_view").val(datas.status == 'Inprogress' ? 'กำลังดำเนินการ' : 'เสร็จสิ้น');
        $("#view_data").modal("show");
    }
}