import smtplib

sender = 'ericksoi3709@gmail.com'
receivers = ['erick.soi@hotmail.com']

message = """From: No Reply <no_reply@mydomain.com>
            To: Person <erick.soi@hotmail.com>
            Subject: Test Email

            This is a test e-mail message.
        """

try:
    smtp_obj = smtplib.SMTP('localhost')
    smtp_obj.sendmail(sender, receivers, message)         
    print("Successfully sent email")
except smtplib.SMTPException:
    print("Error: unable to send email")