## Step X – USB Preparation via PowerShell

Instead of manual DiskPart commands, PowerShell can automate USB cleaning and formatting:

powershell
Get-Disk
Clear-Disk -Number 2 -RemoveData -Confirm:$false
Initialize-Disk -Number 2 -PartitionStyle MBR
New-Partition -DiskNumber 2 -UseMaximumSize -AssignDriveLetter |
    Format-Volume -FileSystem NTFS -NewFileSystemLabel "WIN11USB" -Confirm:$false
