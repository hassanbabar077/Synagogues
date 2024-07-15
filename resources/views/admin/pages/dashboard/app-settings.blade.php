@extends('admin.layout.main')

@section('content')
    <div class="container editor-wrapper">
        <h1 class="table text-white pt-2">{{__('Editor')}}</h1>

        <div class="editor-card">
            <div class="editor-card-body">
                <form id="appsettingsform">
                    @csrf
                    <div id="editor"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-warning mt-3 btn-sm" id="getText" style="background-color: #FEBC06;">{{__('Submit')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var defaultData = {
                "tab_main_tab": @json($tab_main_tab),
                "tab_torah_lessons": @json($tab_torah_lessons),
                "tab_synagogues": @json($tab_synagogues),
                "tab_today_times": @json($tab_today_times),
                "tab_contact_us": @json($tab_contact_us ),
                "info_about_us": @json($info_about_us),
                "info_share": @json($info_share)
            };

            const editor = ace.edit("editor", {
                mode: "ace/mode/json",
                selectionStyle: "text",
                showPrintMargin: false,
                theme: "ace/theme/chrome"
            });

            editor.setValue(JSON.stringify(defaultData, null, 2));

            document.getElementById("appsettingsform").addEventListener("submit", function(event) {
                event.preventDefault();

                try {
                    const jsonData = editor.getValue();
                    const csrfToken = document.querySelector('input[name="_token"]').value;

                    fetch('/editor-text', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                data: jsonData
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                alert(data.error);
                            } else {
                                console.log('Success:', data);
                                alert('Updated Successfully.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Invalid JSON format send, please try again.');
                        });

                } catch (err) {
                    console.error('Error:', err);
                    alert('An error occurred, please try again.');
                }
            });
        });
    </script>
<style>
    .editor-wrapper{
            background-color: #1E2329;
        }
        .editor-card {
            width: 100%;
            /* background-color: lightblue; */
        }

        .editor-card-body {
            width: 100%;
            margin: 0 auto;
            /* background-color: lightblue; */

        }

        #editor {
            height: 300px;
            width: 100%;
            font-size: 14px;
            /* background-color: lightblue; */
        }
</style>
    @php
        $hideFooter = true;
    @endphp
@endsection
