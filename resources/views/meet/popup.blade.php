<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Meeting</title>
    <style>html,body,#meet{height:100%;margin:0}</style>
</head>
<body>
<div id="meet"></div>

<script src="https://meet.hillbcs.com/external_api.js"></script>
<script>
    const qs     = new URLSearchParams(location.search);
    const room   = qs.get('room')   || 'SupportRoom';
    const name   = qs.get('name')   || 'Guest';
    const email  = qs.get('email')  || '';
    const avatar = qs.get('avatar') || '';

    const api = new JitsiMeetExternalAPI('meet.hillbcs.com', {
        roomName: room,
        parentNode: document.getElementById('meet'),
        width: '100%',
        height: '100%',
        userInfo: { displayName: name, email },
        configOverwrite: {
            prejoinConfig: { enabled: false },
            disableDeepLinking: true
        }
    });

    api.addListener('videoConferenceJoined', () => {
        if (avatar) api.executeCommand('avatarUrl', avatar);
        if (name)   api.executeCommand('displayName', name);
        if (email)  api.executeCommand('email', email);
    });
</script>
</body>
</html>
