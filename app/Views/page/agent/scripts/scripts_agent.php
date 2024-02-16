<script>
    $(document).ready(function() {
        checkTokenExpiration();
        var token = localStorage.getItem('jwtToken');

        $.ajax({
            url: "{{ route('agent') }}",
            type: "GET",
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(data) {
                $.each(data, function(index, agent) {
                    var editHref = "{{ route('p.agent.edit', ['id' => ':id']) }}";
                    var agentIdBase64 = btoa(agent.id_agent);
                    editHref = editHref.replace(':id', agentIdBase64);

                    var row = '<tr>' +
                        '<td><a href="' + editHref +
                        '" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="bi bi-pencil-square"></i></a> ' +
                        '<button class="btn btn-danger btn-sm delete-btn" data-id="' + agent
                        .id_agent +
                        '" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="bi bi-trash"></i></button>' +
                        '<td>' + agent.nama_agent + '</td>' +
                        '<td>' + agent.contact_person + '</td>' +
                        '<td>' + agent.telepon + '</td>' +
                        '<td>' + agent.alamat + '</td>' +
                        '</tr>';
                    $('#table1 tbody').append(row);
                });

                // Initialize DataTable after populating the table
                $('#table1').DataTable({
                    "searching": true,
                    "ordering": true,
                    "paging": true
                });

                // Add click event listener to delete buttons
                $('.delete-btn').click(function() {
                    var agentId = $(this).data('id');
                    if (confirm('Are you sure you want to delete this agent?')) {
                        // Perform deletion using AJAX
                        $.ajax({
                            url: "{{ route('agent') }}/" + agentId,
                            type: "DELETE",
                            headers: {
                                'Authorization': 'Bearer ' + token
                            },
                            success: function(response) {
                                // Reload the page or update the table as needed
                                alert('agent deleted successfully!');
                                location
                                    .reload(); // Reload the page after deletion
                            },
                            error: function(xhr, status, error) {
                                alert(
                                    'An error occurred while deleting the agent.'
                                );
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            }
        });
    });
</script>