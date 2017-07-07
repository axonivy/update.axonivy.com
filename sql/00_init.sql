CREATE TABLE EngineLog
(
   Id bigint PRIMARY KEY AUTO_INCREMENT NOT NULL,
	
   Timestamp datetime NOT NULL,
   
   EngineVersion varchar(50) NOT NULL,
   EngineUpTime bigint NOT NULL,
   EngineClusterNodesConfigured tinyint NOT NULL,
   EngineClusterNodesRunning tinyint NOT NULL,
   EngineUsers int NOT NULL,
   EngineLicensedUsers int NOT NULL,
   EngineApplications int NOT NULL,
   EngineProcessModels int NOT NULL,
   EngineProcessModelVersions int NOT NULL,
   EngineProcessModelVersionsDeleted int NOT NULL,
   EngineRunningCases int NOT NULL,
   EngineRunningTasks int NOT NULL,
	
   LicenceNumber varchar(50) NOT NULL,
   LicenceeOrganisation varchar(50) NOT NULL,
   LicenceeIndividual varchar(50) NOT NULL,
   
   SystemDatabaseId bigint NOT NULL,
   SystemDatabaseDriver varchar(200) NOT NULL,
   SystemDatabaseProductName varchar(50) NOT NULL,
   SystemDatabaseProductVersion varchar(50) NOT NULL,
   
   OperatingSystemName varchar(50) NOT NULL,
   OperatingSystemArchitecture varchar(50) NOT NULL,
   OperatingSystemVersion varchar(50) NOT NULL,
   OperatingSystemAvailableProcessors tinyint NOT NULL,
   
   NetworkHostName varchar(50) NOT NULL,
   NetworkIpAddress varchar(64) NOT NULL,
   NetworkHardwareAddress varchar(64) NOT NULL,
   
   MemoryMaxHeap bigint NOT NULL,
   MemoryMaxNonHeap bigint NOT NULL,    
   
   JavaVersion varchar(50) NOT NULL,
   JavaVendor varchar(50) NOT NULL,
   JavaVirtualMachineVersion varchar(50) NOT NULL,
   JavaVirtualMachineVendor varchar(50) NOT NULL,
   JavaVirtualMachineName varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=UTF8 COLLATE utf8_general_ci;

CREATE TABLE DesignerLog
(
   Id bigint PRIMARY KEY AUTO_INCREMENT NOT NULL,
	
   Timestamp datetime NOT NULL,
   
   DesignerVersion varchar(50) NOT NULL,
   
   OperatingSystemName varchar(50) NOT NULL,
   OperatingSystemArchitecture varchar(50) NOT NULL,
   OperatingSystemVersion varchar(50) NOT NULL,
   OperatingSystemAvailableProcessors tinyint NOT NULL,
   
   NetworkHostName varchar(50) NOT NULL,
   NetworkIpAddress varchar(64) NOT NULL,
   NetworkHardwareAddress varchar(64) NOT NULL,
   
   MemoryMaxHeap bigint NOT NULL,
   MemoryMaxNonHeap bigint NOT NULL,    
   
   JavaVersion varchar(50) NOT NULL,
   JavaVendor varchar(50) NOT NULL,
   JavaVirtualMachineVersion varchar(50) NOT NULL,
   JavaVirtualMachineVendor varchar(50) NOT NULL,
   JavaVirtualMachineName varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=UTF8 COLLATE utf8_general_ci;


ALTER TABLE EngineLog AUTO_INCREMENT=300000;
ALTER TABLE DesignerLog AUTO_INCREMENT=300000;

ALTER TABLE EngineLog ADD COLUMN HttpRequestIpAddress varchar(255) NULL;
ALTER TABLE DesignerLog ADD COLUMN HttpRequestIpAddress varchar(255) NULL;