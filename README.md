php-to-s3
---------

Upload and entire source directory recursively to *Amazon S3* from a PHP command line script. The connection with *S3* is over SSL.

All objects are stored using the following *S3* options:

+ private ACL permissions
+ standard storage
+ server side encrypted *(SSE AES256)*

Usage
-----

    usage: php -f php-to-s3.php <bucket-name> <source-dir>
    
Examples
--------

    # Relative source path
    php -f php-to-s3.php my-bucket backups
    
    # Absolute source path
    php -f php-to-s3.php my-bucket /mysql/backups
    

Limitations
-----------

+ The bucket must already exist, i.e. it is **not lazy created**.
+ The bucket must be located in the `US West (Oregon)` region, unless you modify `$s3->setEndpoint("s3-us-west-2.amazonaws.com");`
+ Files larger than **2GB** are not supported on **32 bit** systems due to PHP’s signed integer problem.

Support, Bugs, And Feature Requests
-----------------------------------

Create issues on GitHub (https://github.com/nodesocket/php-to-s3/issues).

License & Legal
---------------

Copyright 2013 NodeSocket, LLC

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this work except in compliance with the License. You may obtain a copy of the License in the LICENSE file, or at:

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.