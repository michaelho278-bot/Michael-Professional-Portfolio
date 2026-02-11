## Steps to Set Up Active Directory on Windows Server 2019

## 1. Prepare the Server
Install Windows Server 2019.
Set a static IP address.
Rename the server to something meaningful.

## 2. Install Active Directory Domain Services (AD DS)
Open Server Manager → Add Roles and Features.
Select Active Directory Domain Services.
Complete the wizard and install.

## 3. Promote the Server to Domain Controller
In Server Manager, click the notification flag → Promote this server to a domain controller.

Choose:
Add a new forest (if this is the first DC).
Enter a domain name.

Configure:
Domain Controller Options: DNS, Global Catalog.

Directory Services Restore Mode (DSRM) password.
Finish and reboot.

## 4. Verify AD Setup
Log back in → open Active Directory Users and Computers (ADUC).
You should see your domain (corp.local).
Create Organizational Units (OUs) (e.g., Users, Computers, Groups).
Add test users and computers.

## 5. Join Client Machines
On a Windows 10 client:
Go to System → About → Domain join.
Enter domain name (corp.local).
Provide domain admin credentials.
Verify the client appears in ADUC under Computers.
