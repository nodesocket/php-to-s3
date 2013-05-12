php-to-s3
---------

####Upload an entire source directory recursively to *Amazon S3* from a PHP command line interface. The connection with *S3* is over SSL.####

All objects are stored using the following *S3* options:

+ private ACL permissions
+ standard storage
+ server side encrypted *(AES256)*

Usage
-----

Set your **AWS ACCESS KEY** and **AWS SECRET KEY** directly in `php-to-s3.php`, or if your feeling fancy in environmental variables `AWS_ACCESS_KEY` and `AWS_SECRET_KEY`.

```` bash
usage: php -f php-to-s3.php <bucket-name> <source-dir>
````
    
Examples
--------

```` bash
# Relative source path
php -f php-to-s3.php my-bucket ../backups/
````

```` bash    
# Absolute source path
php -f php-to-s3.php my-bucket /mysql/backups/
````

```` bash
# Get the version of php-to-s3
php -f php-to-s3.php version
````

Limitations
-----------

+ The bucket must already exist, i.e. it is **not lazy created**.
+ The bucket must be located in the **US West (Oregon)** region, unless you modify `$s3->setEndpoint("s3-us-west-2.amazonaws.com");`
+ Files larger than **2GB** are not supported on **32 bit** systems due to PHP’s signed integer problem.

Current Version
---------------

https://github.com/nodesocket/php-to-s3/blob/master/VERSION

Support, Bugs, And Feature Requests
-----------------------------------

Create issues here on GitHub (https://github.com/nodesocket/php-to-s3/issues).

Versioning
----------

For transparency and insight into our release cycle, and for striving to maintain backward compatibility, php-to-s3 will be maintained under the semantic versioning guidelines.

Releases will be numbered with the follow format:

`<major>.<minor>.<patch>`

And constructed with the following guidelines:

+ Breaking backward compatibility bumps the major (and resets the minor and patch)
+ New additions without breaking backward compatibility bumps the minor (and resets the patch)
+ Bug fixes and misc changes bumps the patch

For more information on semantic versioning, visit http://semver.org/.

License & Legal
---------------

Copyright 2013 NodeSocket, LLC

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this work except in compliance with the License. You may obtain a copy of the License in the LICENSE file, or at:

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.

Amazon S3 is a trademark of Amazon.com, Inc. or its affiliates.