INSERT INTO DesignerLog (
		Id,
		Timestamp,
		DesignerVersion,
		HttpRequestIpAddress,
		OperatingSystemName, OperatingSystemArchitecture, OperatingSystemVersion, OperatingSystemAvailableProcessors,
		NetworkHostName, NetworkIpAddress, NetworkHardwareAddress,
		MemoryMaxHeap, MemoryMaxNonHeap,
		JavaVersion, JavaVendor, JavaVirtualMachineVersion, JavaVirtualMachineVendor, JavaVirtualMachineName
) VALUES (
 		100,
		'2017-05-06 15:06:44',
		'6.6.0',
		'255.666.75.45',
		'OS_NAME', 'OS_ARCH', 'OS_VERSION', 8,
		'NET_HOSTNAME',	'NET_IP', 'NET_MAC',
		512, 16,
		'JAVA_VERSION', 'JAVA_VENDOR', 'JVM_VERSION', 'JVM_VENDOR',	'JVM_NAME'
);

INSERT INTO DesignerLog (
		Id,
		Timestamp,
		DesignerVersion,
		HttpRequestIpAddress,
		OperatingSystemName, OperatingSystemArchitecture, OperatingSystemVersion, OperatingSystemAvailableProcessors,
		NetworkHostName, NetworkIpAddress, NetworkHardwareAddress,
		MemoryMaxHeap, MemoryMaxNonHeap,
		JavaVersion, JavaVendor, JavaVirtualMachineVersion, JavaVirtualMachineVendor, JavaVirtualMachineName
) VALUES (
 		101,
		'2017-05-06 15:07:44',
		'6.6.1',
		'255.666.75.5',
		'OS_NAME2', 'OS_ARCH2', 'OS_VERSION2', 16,
		'NET_HOSTNAME2','NET_IP2', 'NET_MAC2',
		1024, 9,
		'JAVA_VERSION2', 'JAVA_VENDOR2', 'JVM_VERSION2', 'JVM_VENDOR2', 'JVM_NAME2'
);

INSERT INTO DesignerLog (
		Id,
		Timestamp,
		DesignerVersion,
		HttpRequestIpAddress,
		OperatingSystemName, OperatingSystemArchitecture, OperatingSystemVersion, OperatingSystemAvailableProcessors,
		NetworkHostName, NetworkIpAddress, NetworkHardwareAddress,
		MemoryMaxHeap, MemoryMaxNonHeap,
		JavaVersion, JavaVendor, JavaVirtualMachineVersion, JavaVirtualMachineVendor, JavaVirtualMachineName
) VALUES (
 		102,
		'2017-05-06 17:07:44',
		'6.6.1',
		'255.666.75.46',
		'OS_NAME', 'OS_ARCH', 'OS_VERSION', 8,
		'NET_HOSTNAME',	'NET_IP', 'NET_MAC',
		512, 16,
		'JAVA_VERSION', 'JAVA_VENDOR', 'JVM_VERSION', 'JVM_VENDOR',	'JVM_NAME'
);



INSERT INTO EngineLog (
		Id,
		Timestamp,
		HttpRequestIpAddress,
		
		EngineVersion, EngineUpTime, EngineClusterNodesConfigured, EngineClusterNodesRunning, EngineUsers,
   		EngineLicensedUsers, EngineApplications, EngineProcessModels,
   		EngineProcessModelVersions, EngineProcessModelVersionsDeleted, EngineRunningCases,
   		EngineRunningTasks,
		
		LicenceNumber, LicenceeOrganisation, LicenceeIndividual,
		
	    SystemDatabaseId, SystemDatabaseDriver, SystemDatabaseProductName, SystemDatabaseProductVersion,
		
		OperatingSystemName, OperatingSystemArchitecture, OperatingSystemVersion, OperatingSystemAvailableProcessors,
		NetworkHostName, NetworkIpAddress, NetworkHardwareAddress,
		MemoryMaxHeap, MemoryMaxNonHeap,
		JavaVersion, JavaVendor, JavaVirtualMachineVersion, JavaVirtualMachineVendor, JavaVirtualMachineName
) VALUES (
 		100,
		'2017-05-06 15:06:44',
		'255.66.75.45',
	
		'6.4.0', 1000, 9, 8, 7,
	    5,4,3,
	    2, 55, 66,
	    99,
	    
	    'LICENSE_NUMBER', 'LICENSE_ORGANISATION', 'LICENSE_INDIVIDUAL',
	    
	    5456, 'DB_DRIVER', 'DB_PRODUCT_NAME', 'DB_PRODUCT_VERSION',
	    
		'OS_NAME', 'OS_ARCH', 'OS_VERSION', 8,
		'NET_HOSTNAME',	'NET_IP', 'NET_MAC',
		512, 16,
		'JAVA_VERSION', 'JAVA_VENDOR', 'JVM_VERSION', 'JVM_VENDOR',	'JVM_NAME'
);