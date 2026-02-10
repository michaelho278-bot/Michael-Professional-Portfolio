# Lab Guide: Windows No-GUI Rescue Workflow (Simulated)

## Scenario
Windows GUI fails to load, leaving only command-line access or automatically entering Recovery Environment.  
Objective: Demonstrate how IT Support staff can use **WinRE + PowerShell** to perform rescue operations.

---

## Step 1 – Enter Windows Recovery Environment (WinRE)
- Method 1: After several failed boot attempts, system automatically enters WinRE.  
- Method 2: From login screen or desktop → hold **Shift + Restart** → enter WinRE.  
- Method 3: Boot from USB installation media → choose "Repair your computer".  

*(Screenshot placeholder: WinRE main screen)*

---

## Step 2 – Launch Safe Mode
- WinRE → "Troubleshoot" → "Advanced options" → "Startup Settings" → Restart.  
- Choose **4 (Safe Mode)** or **6 (Safe Mode with Networking)**.  

*(Screenshot placeholder: Safe Mode login screen)*

---

## Step 3 – Disk Check and Repair (PowerShell)
powershell
Get-Disk
Get-Partition
Get-Volume
Verify SSD / USB presence.

If USB needs cleaning:

powershell
Clear-Disk -Number 2 -RemoveData -Confirm:$false
Initialize-Disk -Number 2 -PartitionStyle MBR
New-Partition -DiskNumber 2 -UseMaximumSize -AssignDriveLetter |
    Format-Volume -FileSystem NTFS -NewFileSystemLabel "RecoveryUSB" -Confirm:$false
(Screenshot placeholder: PowerShell output)

## Step 4 – Network Diagnostics (No GUI)
powershell
Test-Connection google.com -Count 4
Get-NetAdapter
Get-NetIPAddress
Confirm network connectivity.

If manual IP configuration is required:

powershell
New-NetIPAddress -InterfaceAlias "Ethernet0" -IPAddress 192.168.1.100 -PrefixLength 24 -DefaultGateway 192.168.1.1

## Step 5 – User Account Management
powershell
Get-LocalUser
New-LocalUser -Name "SupportUser" -Password (Read-Host -AsSecureString "Enter Password")
Add-LocalGroupMember -Group "Administrators" -Member "SupportUser"
Create a temporary account for system access.

## Consultant-style Analysis
BIOS layer: Verify hardware presence first.

WinRE layer: Provides entry to Safe Mode and recovery tools.

PowerShell layer: Enables disk operations, network troubleshooting, and account management without GUI.

