
#include<stdio.h>
#include<stdlib.h>
#include<time.h>
#define MAX 100000
int arr[MAX];
void insertSort(int n)
{
	int j,key,i;
	for(j=1;j<n;j++)
	{
		key=arr[j];
		i=j-1;
		while(i>=0 && arr[i]>key)
		{
			arr[i+1]=arr[i];
			i=i-1;
		}
		arr[i+1]=key;
	}
}
int main()
{
	int n,i;
	time_t secs;
	n=MAX;
	secs=time(NULL);
	printf("timestmap:%ld\n",secs);
//	printf("Number of elements:\n");
//	scanf("%d",&n);
	for(i=0;i<n;i++)
	{
//		scanf("%d",&arr[i]);
		arr[i]=rand();
	}
	insertSort(n);
	for(i=0;i<n;i++)
		//printf("%d\t",arr[i]);
	secs=time(NULL);
	printf("timestmap:%ld\n",secs);
	return 0;
}
